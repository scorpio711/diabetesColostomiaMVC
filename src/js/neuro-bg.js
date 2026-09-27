/* neuro-bg.js
 * Fondo interactivo tipo red neuronal/vascular con onda de pulso ECG al mover el mouse.
 * Compatible con modo oscuro (Tailwind `dark` class en <html>).
 * Sin dependencias externas.
 */
(function () {
  "use strict";

  const canvas = document.getElementById("neuro-bg");
  if (!canvas) return;
  const ctx = canvas.getContext("2d", { alpha: true });

  // ---------- Config ----------
  const CONFIG = {
    baseDensity: 9000,      // px^2 por partícula (menos = más partículas)
    maxParticles: 140,
    minParticles: 40,
    linkDistance: 130,      // distancia máxima para dibujar conexión
    mouseRadius: 160,       // radio de influencia del mouse
    mouseRepel: 0.55,       // fuerza de repulsión
    speed: 0.25,            // velocidad base de las partículas
    pulseSpeed: 260,        // px/seg que viaja la onda ECG
    pulseLifetime: 1.1,     // segundos de vida de cada pulso
    pulseTriggerDist: 40,   // distancia mínima de movimiento del mouse para disparar pulso
  };

  // Paletas: claro / oscuro
  const PALETTES = {
    light: {
      bg: null, // el CSS ya pinta el fondo
      particle: "rgba(13, 110, 100, 0.55)",
      link: "rgba(20, 130, 110, 0.15)",
      linkActive: "rgba(16, 185, 129, 0.55)",
      pulse: "rgba(16, 185, 129, 0.95)",
      pulseGlow: "rgba(16, 185, 129, 0.35)",
    },
    dark: {
      bg: null,
      particle: "rgba(110, 231, 183, 0.55)",
      link: "rgba(45, 212, 191, 0.12)",
      linkActive: "rgba(52, 211, 153, 0.6)",
      pulse: "rgba(74, 222, 128, 0.95)",
      pulseGlow: "rgba(74, 222, 128, 0.4)",
    },
  };

  let palette = PALETTES.light;
  let isDark = document.documentElement.classList.contains("dark");

  function refreshPalette() {
    isDark = document.documentElement.classList.contains("dark");
    palette = isDark ? PALETTES.dark : PALETTES.light;
  }

  // Observa cambios de clase en <html> para reaccionar al toggle de dark mode
  const themeObserver = new MutationObserver(refreshPalette);
  themeObserver.observe(document.documentElement, {
    attributes: true,
    attributeFilter: ["class"],
  });

  // ---------- Canvas sizing ----------
  let width = 0, height = 0, dpr = Math.min(window.devicePixelRatio || 1, 2);

  function resize() {
    width = window.innerWidth;
    height = window.innerHeight;
    dpr = Math.min(window.devicePixelRatio || 1, 2);
    canvas.width = Math.floor(width * dpr);
    canvas.height = Math.floor(height * dpr);
    canvas.style.width = width + "px";
    canvas.style.height = height + "px";
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    initParticles();
  }

  // ---------- Particles ----------
  let particles = [];

  function particleCount() {
    const n = Math.round((width * height) / CONFIG.baseDensity);
    return Math.max(CONFIG.minParticles, Math.min(CONFIG.maxParticles, n));
  }

  function initParticles() {
    const n = particleCount();
    particles = new Array(n).fill(0).map(() => ({
      x: Math.random() * width,
      y: Math.random() * height,
      vx: (Math.random() - 0.5) * CONFIG.speed,
      vy: (Math.random() - 0.5) * CONFIG.speed,
      r: 1.4 + Math.random() * 1.6,
    }));
  }

  // ---------- Mouse ----------
  const mouse = { x: -9999, y: -9999, lastX: -9999, lastY: -9999, active: false };

  window.addEventListener("mousemove", (e) => {
    mouse.x = e.clientX;
    mouse.y = e.clientY;
    mouse.active = true;

    const dx = mouse.x - mouse.lastX;
    const dy = mouse.y - mouse.lastY;
    const dist = Math.sqrt(dx * dx + dy * dy);

    if (dist > CONFIG.pulseTriggerDist) {
      spawnPulse(mouse.x, mouse.y);
      mouse.lastX = mouse.x;
      mouse.lastY = mouse.y;
    }
  }, { passive: true });

  window.addEventListener("mouseleave", () => {
    mouse.active = false;
    mouse.x = -9999;
    mouse.y = -9999;
  });

  // ---------- ECG Pulse waves ----------
  // Cada pulso nace en el punto más cercano al mouse y viaja hacia los nodos conectados,
  // dibujando un pequeño trazo tipo QRS a lo largo del segmento.
  let pulses = [];

  function nearestParticle(x, y) {
    let best = null, bestD = Infinity;
    for (const p of particles) {
      const d = (p.x - x) ** 2 + (p.y - y) ** 2;
      if (d < bestD) { bestD = d; best = p; }
    }
    return best;
  }

  function spawnPulse(x, y) {
    const origin = nearestParticle(x, y);
    if (!origin) return;
    // Encuentra vecinos enlazados al origen para propagar el pulso por la "red"
    const neighbors = particles
      .filter((p) => p !== origin)
      .map((p) => ({ p, d: Math.hypot(p.x - origin.x, p.y - origin.y) }))
      .filter((o) => o.d < CONFIG.linkDistance * 1.4)
      .sort((a, b) => a.d - b.d)
      .slice(0, 4);

    if (neighbors.length === 0) return;

    for (const { p: target, d } of neighbors) {
      pulses.push({
        x0: origin.x, y0: origin.y,
        x1: target.x, y1: target.y,
        dist: d,
        born: performance.now(),
        duration: (d / CONFIG.pulseSpeed) + CONFIG.pulseLifetime,
      });
    }
    if (pulses.length > 60) pulses.splice(0, pulses.length - 60);
  }

  // Forma de una onda ECG (P-QRS-T) muestreada de 0 a 1 -> desplazamiento normal (-1..1)
  function ecgShape(t) {
    // t en [0,1] a lo largo del segmento de la conexión
    if (t < 0.15) return 0.15 * Math.sin((t / 0.15) * Math.PI); // onda P
    if (t < 0.30) return 0;
    if (t < 0.35) return -0.3 * ((t - 0.30) / 0.05);            // Q
    if (t < 0.45) return -0.3 + 1.6 * ((t - 0.35) / 0.10);      // R (pico)
    if (t < 0.55) return 1.3 - 1.6 * ((t - 0.45) / 0.10);       // S
    if (t < 0.70) return -0.3 + 0.3 * ((t - 0.55) / 0.15);
    if (t < 0.90) return 0.25 * Math.sin(((t - 0.70) / 0.20) * Math.PI); // onda T
    return 0;
  }

  function drawPulses(now) {
    pulses = pulses.filter((p) => (now - p.born) / 1000 < p.duration);

    for (const pulse of pulses) {
      const elapsed = (now - pulse.born) / 1000;
      const travel = Math.min(1, (elapsed * CONFIG.pulseSpeed) / pulse.dist);
      if (travel <= 0) continue;

      const fade = 1 - Math.max(0, (elapsed - pulse.dist / CONFIG.pulseSpeed) / CONFIG.pulseLifetime);
      if (fade <= 0) continue;

      const dx = pulse.x1 - pulse.x0;
      const dy = pulse.y1 - pulse.y0;
      const len = Math.hypot(dx, dy) || 1;
      const nx = -dy / len; // normal para desplazar la onda perpendicularmente
      const ny = dx / len;

      const segments = 24;
      ctx.beginPath();
      ctx.lineWidth = 2 * fade;
      ctx.strokeStyle = palette.pulse;
      ctx.shadowColor = palette.pulseGlow;
      ctx.shadowBlur = 8 * fade;

      let started = false;
      for (let i = 0; i <= segments; i++) {
        const t = i / segments;
        if (t > travel) break;
        const baseX = pulse.x0 + dx * t;
        const baseY = pulse.y0 + dy * t;
        const amp = 14 * fade;
        const offset = ecgShape(t) * amp;
        const px = baseX + nx * offset;
        const py = baseY + ny * offset;
        if (!started) { ctx.moveTo(px, py); started = true; }
        else ctx.lineTo(px, py);
      }
      ctx.stroke();
      ctx.shadowBlur = 0;
    }
  }

  // ---------- Main render loop ----------
  function step() {
    for (const p of particles) {
      p.x += p.vx;
      p.y += p.vy;

      if (p.x < 0 || p.x > width) p.vx *= -1;
      if (p.y < 0 || p.y > height) p.vy *= -1;

      if (mouse.active) {
        const dx = p.x - mouse.x;
        const dy = p.y - mouse.y;
        const dist = Math.hypot(dx, dy);
        if (dist < CONFIG.mouseRadius && dist > 0.01) {
          const force = (1 - dist / CONFIG.mouseRadius) * CONFIG.mouseRepel;
          p.vx += (dx / dist) * force * 0.06;
          p.vy += (dy / dist) * force * 0.06;
        }
      }

      // fricción para que no se disparen indefinidamente
      p.vx *= 0.985;
      p.vy *= 0.985;

      const speedCap = 1.4;
      const sp = Math.hypot(p.vx, p.vy);
      if (sp > speedCap) {
        p.vx = (p.vx / sp) * speedCap;
        p.vy = (p.vy / sp) * speedCap;
      }
    }
  }

  function draw(now) {
    ctx.clearRect(0, 0, width, height);

    // Conexiones (red neuronal/vascular)
    for (let i = 0; i < particles.length; i++) {
      const a = particles[i];
      for (let j = i + 1; j < particles.length; j++) {
        const b = particles[j];
        const dx = a.x - b.x, dy = a.y - b.y;
        const dist = Math.hypot(dx, dy);
        if (dist < CONFIG.linkDistance) {
          const nearMouse =
            mouse.active &&
            (Math.hypot(a.x - mouse.x, a.y - mouse.y) < CONFIG.mouseRadius ||
              Math.hypot(b.x - mouse.x, b.y - mouse.y) < CONFIG.mouseRadius);

          const alpha = 1 - dist / CONFIG.linkDistance;
          ctx.strokeStyle = nearMouse ? palette.linkActive : palette.link;
          ctx.globalAlpha = nearMouse ? Math.min(1, alpha + 0.25) : alpha;
          ctx.lineWidth = nearMouse ? 1.2 : 0.7;
          ctx.beginPath();
          ctx.moveTo(a.x, a.y);
          ctx.lineTo(b.x, b.y);
          ctx.stroke();
        }
      }
    }
    ctx.globalAlpha = 1;

    // Nodos
    for (const p of particles) {
      ctx.beginPath();
      ctx.fillStyle = palette.particle;
      ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
      ctx.fill();
    }

    drawPulses(now);
  }

  let rafId = null;
  function loop(now) {
    step();
    draw(now);
    rafId = requestAnimationFrame(loop);
  }

  function start() {
    if (rafId === null) rafId = requestAnimationFrame(loop);
  }
  function stop() {
    if (rafId !== null) { cancelAnimationFrame(rafId); rafId = null; }
  }

  document.addEventListener("visibilitychange", () => {
    if (document.hidden) stop(); else start();
  });

  window.addEventListener("resize", resize);

  // ---------- Init ----------
  refreshPalette();
  resize();
  start();
})();
