<?php
// Solo se ejecuta si es admin real o está en modo simulación
$esAdminReal = !empty($_SESSION['admin']) || !empty($_SESSION['admin_real']);
if (!$esAdminReal) {
    return;
}

$rolActual = $_SESSION['rol'] ?? 'admin';
$enfermedadActual = $_SESSION['enfermedad'] ?? 'Ninguna';
$simulando = $_SESSION['simulando'] ?? null;
$nombreAdmin = $_SESSION['admin_nombre_original'] ?? ($_SESSION['nombre'] ?? 'Administrador');
$currentUri = $_SERVER['REQUEST_URI'] ?? '/public';
?>

<!-- ==========================================
     INTERACTIVE QUICK CONTROLS TOOLBAR (ADMIN)
     ========================================== -->
<div id="admin-quick-toolbar-container" class="fixed bottom-4 left-1/2 -translate-x-1/2 z-[9999] w-[95%] max-w-5xl transition-all duration-300 pointer-events-auto font-sans">
    
    <!-- Botón Flotante para cuando la barra está minimizada -->
    <div id="toolbar-minimized-pill" class="hidden mx-auto w-fit">
        <button type="button" 
                id="btn-expand-toolbar"
                class="flex items-center gap-2.5 px-4 py-2 bg-slate-900/95 dark:bg-slate-950/95 text-white backdrop-blur-xl border border-emerald-500/50 shadow-2xl rounded-full text-xs font-semibold hover:scale-105 hover:bg-slate-800 transition-all cursor-pointer">
            <span class="w-2.5 h-2.5 rounded-full <?= $simulando ? 'bg-amber-400 animate-ping' : 'bg-emerald-400 animate-pulse' ?>"></span>
            <span class="text-emerald-400 font-bold">Admin Toolbar</span>
            <?php if ($simulando): ?>
                <span class="px-2 py-0.5 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/40 text-[10px]">
                    Simulando: <?= htmlspecialchars($simulando) ?>
                </span>
            <?php endif; ?>
            <svg class="w-4 h-4 text-slate-400 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
            </svg>
        </button>
    </div>

    <!-- Panel Completo de la Barra de Controles -->
    <div id="toolbar-panel" class="bg-slate-900/95 dark:bg-slate-950/95 text-slate-100 backdrop-blur-2xl border border-slate-700/80 rounded-2xl shadow-2xl p-4 sm:p-5 relative transition-all">
        
        <!-- Barra Superior: Info, Estado y Botones de Control -->
        <div class="flex flex-wrap items-center justify-between gap-3 pb-3 mb-3 border-b border-slate-800 text-xs">
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2">
                    <span class="flex h-2.5 w-2.5 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full <?= $simulando ? 'bg-amber-400 opacity-75' : 'bg-emerald-400 opacity-75' ?>"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 <?= $simulando ? 'bg-amber-500' : 'bg-emerald-500' ?>"></span>
                    </span>
                    <span class="font-bold tracking-wider uppercase text-emerald-400">Quick Controls Toolbar</span>
                </div>

                <!-- Badge de Rol Activo -->
                <?php if ($simulando): ?>
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/40 font-medium">
                        Simulando: <strong><?= htmlspecialchars($simulando) ?></strong>
                    </span>
                    <a href="/public/admin/simular-rol?rol=admin" 
                       class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white font-semibold transition-colors shadow-sm">
                        <span>👑 Restaurar Admin</span>
                    </a>
                <?php else: ?>
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/40 font-medium">
                        👑 Administrador General
                    </span>
                <?php endif; ?>
            </div>

            <!-- Utilidades Extra y Minimizar -->
            <div class="flex items-center gap-2">
                <!-- Toggle Dark Mode -->
                <button type="button" 
                        id="toolbar-toggle-theme" 
                        title="Alternar Modo Oscuro / Claro"
                        class="p-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white border border-slate-700 transition-colors flex items-center gap-1.5 text-[11px]">
                    <span id="theme-icon">🌓</span>
                    <span class="hidden sm:inline">Tema</span>
                </button>

                <!-- Recargar Vista Limpia -->
                <button type="button" 
                        onclick="window.location.reload();" 
                        title="Recargar vista limpia"
                        class="p-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white border border-slate-700 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </button>

                <!-- Botón Minimizar -->
                <button type="button" 
                        id="btn-minimize-toolbar" 
                        title="Minimizar barra"
                        class="p-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-400 hover:text-white border border-slate-700 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Controles Principales: Selector de Vistas / Roles -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-2">
            
            <!-- 1. Vista Abogado -->
            <a href="/public/admin/simular-rol?rol=abogado" 
               class="flex flex-col items-center justify-center p-2.5 rounded-xl border transition-all text-center group <?= ($simulando === 'Abogado') ? 'bg-indigo-950/80 border-indigo-400 text-indigo-300 shadow-md ring-2 ring-indigo-400/30' : 'bg-slate-800/80 border-slate-700/80 hover:bg-slate-800 hover:border-indigo-500/50 text-slate-300' ?>">
                <span class="text-xl mb-1 group-hover:scale-110 transition-transform">⚖️</span>
                <span class="text-xs font-bold leading-tight">Abogado</span>
                <span class="text-[10px] text-slate-400 mt-0.5">Asesoría Jurídica</span>
            </a>

            <!-- 2. Vista Psicólogo -->
            <a href="/public/admin/simular-rol?rol=psicologo" 
               class="flex flex-col items-center justify-center p-2.5 rounded-xl border transition-all text-center group <?= ($simulando === 'Psicólogo') ? 'bg-blue-950/80 border-blue-400 text-blue-300 shadow-md ring-2 ring-blue-400/30' : 'bg-slate-800/80 border-slate-700/80 hover:bg-slate-800 hover:border-blue-500/50 text-slate-300' ?>">
                <span class="text-xl mb-1 group-hover:scale-110 transition-transform">🧠</span>
                <span class="text-xs font-bold leading-tight">Psicólogo</span>
                <span class="text-[10px] text-slate-400 mt-0.5">Atención Emocional</span>
            </a>

            <!-- 3. Vista Enfermero -->
            <a href="/public/admin/simular-rol?rol=enfermero" 
               class="flex flex-col items-center justify-center p-2.5 rounded-xl border transition-all text-center group <?= ($simulando === 'Enfermero') ? 'bg-teal-950/80 border-teal-400 text-teal-300 shadow-md ring-2 ring-teal-400/30' : 'bg-slate-800/80 border-slate-700/80 hover:bg-slate-800 hover:border-teal-500/50 text-slate-300' ?>">
                <span class="text-xl mb-1 group-hover:scale-110 transition-transform">🩺</span>
                <span class="text-xs font-bold leading-tight">Enfermero</span>
                <span class="text-[10px] text-slate-400 mt-0.5">Cuidado Clínico</span>
            </a>

            <!-- 4. Vista Paciente Ostomizado -->
            <a href="/public/admin/simular-rol?rol=colostomia" 
               class="flex flex-col items-center justify-center p-2.5 rounded-xl border transition-all text-center group <?= ($simulando === 'Paciente Ostomizado') ? 'bg-purple-950/80 border-purple-400 text-purple-300 shadow-md ring-2 ring-purple-400/30' : 'bg-slate-800/80 border-slate-700/80 hover:bg-slate-800 hover:border-purple-500/50 text-slate-300' ?>">
                <span class="text-xl mb-1 group-hover:scale-110 transition-transform">🩹</span>
                <span class="text-xs font-bold leading-tight">Ostomizado</span>
                <span class="text-[10px] text-slate-400 mt-0.5">Área Colostomía</span>
            </a>

            <!-- 5. Vista Paciente Diabético -->
            <a href="/public/admin/simular-rol?rol=diabetes" 
               class="flex flex-col items-center justify-center p-2.5 rounded-xl border transition-all text-center group <?= ($simulando === 'Paciente Diabético') ? 'bg-cyan-950/80 border-cyan-400 text-cyan-300 shadow-md ring-2 ring-cyan-400/30' : 'bg-slate-800/80 border-slate-700/80 hover:bg-slate-800 hover:border-cyan-500/50 text-slate-300' ?>">
                <span class="text-xl mb-1 group-hover:scale-110 transition-transform">🩸</span>
                <span class="text-xs font-bold leading-tight">Diabético</span>
                <span class="text-[10px] text-slate-400 mt-0.5">Área Diabetes</span>
            </a>

            <!-- 6. Vista Administrador (Restaurar) -->
            <a href="/public/admin/simular-rol?rol=admin" 
               class="flex flex-col items-center justify-center p-2.5 rounded-xl border transition-all text-center group <?= (!$simulando) ? 'bg-emerald-950/80 border-emerald-400 text-emerald-300 shadow-md ring-2 ring-emerald-400/30' : 'bg-slate-800/80 border-slate-700/80 hover:bg-slate-800 hover:border-emerald-500/50 text-slate-300' ?>">
                <span class="text-xl mb-1 group-hover:scale-110 transition-transform">👑</span>
                <span class="text-xs font-bold leading-tight">Administrador</span>
                <span class="text-[10px] text-slate-400 mt-0.5">Control Total</span>
            </a>
        </div>

        <!-- Barra Inferior: Salto Rápido a Secciones Administrativas -->
        <div class="mt-3 pt-3 border-t border-slate-800 flex flex-wrap items-center justify-between gap-2 text-[11px] text-slate-400">
            <div class="flex items-center gap-1.5 flex-wrap">
                <span class="font-semibold text-slate-300 mr-1">Ir a:</span>
                <a href="/public/admin/index" class="px-2 py-0.5 rounded bg-slate-800 hover:bg-slate-700 hover:text-white transition-colors">📊 Dashboard</a>
                <a href="/public/admin/usuarios/administrar" class="px-2 py-0.5 rounded bg-slate-800 hover:bg-slate-700 hover:text-white transition-colors">👥 Usuarios</a>
                <a href="/public/admin/pacientes/administrar" class="px-2 py-0.5 rounded bg-slate-800 hover:bg-slate-700 hover:text-white transition-colors">📑 Pacientes</a>
                <a href="/public/admin/profesionales/administrar" class="px-2 py-0.5 rounded bg-slate-800 hover:bg-slate-700 hover:text-white transition-colors">🩺 Profesionales</a>
                <a href="/public/admin/citas" class="px-2 py-0.5 rounded bg-slate-800 hover:bg-slate-700 hover:text-white transition-colors">📅 Citas</a>
                <a href="/public/admin/investigaciones/administrar" class="px-2 py-0.5 rounded bg-slate-800 hover:bg-slate-700 hover:text-white transition-colors">🔬 Investigaciones</a>
                <a href="/public/admin/blog" class="px-2 py-0.5 rounded bg-slate-800 hover:bg-slate-700 hover:text-white transition-colors">📰 Blog</a>
                <a href="/public/admin/encuestaSalud" class="px-2 py-0.5 rounded bg-slate-800 hover:bg-slate-700 hover:text-white transition-colors">📋 Encuestas</a>
            </div>
            
            <div class="text-[10px] text-slate-500 font-mono">
                Atajo: <kbd class="px-1.5 py-0.5 rounded bg-slate-800 text-slate-300 border border-slate-700">Ctrl + Shift + A</kbd>
            </div>
        </div>

    </div>
</div>

<!-- Script Interactivo del Quick Controls Toolbar -->
<script>
(function() {
    const pill = document.getElementById('toolbar-minimized-pill');
    const panel = document.getElementById('toolbar-panel');
    const btnMinimize = document.getElementById('btn-minimize-toolbar');
    const btnExpand = document.getElementById('btn-expand-toolbar');
    const btnTheme = document.getElementById('toolbar-toggle-theme');

    // Estado guardado en localStorage
    const STORAGE_KEY = 'admin_toolbar_minimized';
    
    function setMinimized(minimized) {
        if (minimized) {
            panel.classList.add('hidden');
            pill.classList.remove('hidden');
            localStorage.setItem(STORAGE_KEY, 'true');
        } else {
            panel.classList.remove('hidden');
            pill.classList.add('hidden');
            localStorage.setItem(STORAGE_KEY, 'false');
        }
    }

    // Inicializar estado guardado
    if (localStorage.getItem(STORAGE_KEY) === 'true') {
        setMinimized(true);
    }

    if (btnMinimize) {
        btnMinimize.addEventListener('click', function(e) {
            e.preventDefault();
            setMinimized(true);
        });
    }

    if (btnExpand) {
        btnExpand.addEventListener('click', function(e) {
            e.preventDefault();
            setMinimized(false);
        });
    }

    // Atajo de teclado: Ctrl + Shift + A para alternar
    window.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.shiftKey && (e.key === 'A' || e.key === 'a')) {
            e.preventDefault();
            const isHidden = panel.classList.contains('hidden');
            setMinimized(!isHidden);
        }
    });

    // Alternar tema Dark/Light
    if (btnTheme) {
        btnTheme.addEventListener('click', function() {
            const html = document.documentElement;
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        });
    }
})();
</script>
