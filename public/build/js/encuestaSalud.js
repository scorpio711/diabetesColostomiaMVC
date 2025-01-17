document.addEventListener("DOMContentLoaded",()=>{gsap.registerPlugin(MotionPathPlugin),tabs()});const inputs=document.querySelectorAll(".steps-range");function handleRangeChange(e){switch(Math.floor(e/25)){case 0:animarEstrella("verde");break;case 1:animarEstrella("amarilla");break;case 2:animarEstrella("naranja");break;case 3:animarEstrella("roja")}}function animarEstrella(e){const a=document.getElementById("estrella"+(e.charAt(0).toUpperCase()+e.slice(1)));gsap.timeline().set(a,{opacity:1,scale:1}).fromTo(a,{opacity:0,scale:1},{opacity:1,scale:1,duration:1}).to(a,{scale:2,duration:1}).to(a,{scale:1,duration:1})}function tabs(){const e=document.querySelectorAll('[role="tab"]'),a=document.querySelectorAll('[role="tabpanel"]'),t=document.querySelectorAll(".relative img");let n=0;const i=["He tenido dificultades al realizar los cuidados que necesito para mantener adcuadamente mi salud, por:","He tenido dificultades al realizar los cambios en mi alimentación que son necesarios para mantener mi salud, por:","He tenido dificultades al realizar la actividad física que necesito para mantener mi salud, por:","He tenido dificultades para usar la vestimenta y/o accesorio y/o calzado que mejor se adapta a mis necesidades de salud, por: ","He tenido dificultades para identificar los signos de alarma y acudir a los servicios especializados ante complicaciones en mi salud, por: "];const s=document.getElementById("pregunta"),l=document.getElementById("next-tab"),o=document.getElementById("prev-tab"),d=document.getElementById("finalizar-tab");function r(n){e.forEach((e,t)=>{e.setAttribute("aria-selected",t===n?"true":"false"),a[t].classList.toggle("hidden",t!==n)}),n<i.length&&gsap.to(s,{duration:.5,text:i[n],ease:"none"}),t.forEach((e,a)=>{a===n?e.classList.remove("grayscale"):e.classList.add("grayscale")}),n===e.length-1?(l.classList.add("hidden"),d.classList.remove("hidden")):(l.classList.remove("hidden"),d.classList.add("hidden"))}l.addEventListener("click",()=>{n<e.length-1&&n++,r(n)}),o.addEventListener("click",()=>{n>0&&n--,r(n)}),d.addEventListener("click",()=>{setTimeout((function(){window.location.reload()}),500)}),r(n),document.getElementById("card__arrow").addEventListener("click",()=>{n<e.length-1&&n++,r(n)})}inputs.forEach(e=>{console.log("Inicializando input con valor: "+e.value),e.addEventListener("input",e=>{handleRangeChange(parseInt(e.target.value,10))})});