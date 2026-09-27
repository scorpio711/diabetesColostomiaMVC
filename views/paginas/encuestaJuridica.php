<?php
$encuestaHabilitada = intval($encuestaHabilitada ?? 0);
?>
<main class="min-h-screen pt-24 pb-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-slate-50 via-amber-50/20 to-slate-50 dark:from-slate-900 dark:via-slate-850 dark:to-slate-900 transition-colors">
    <div class="max-w-6xl mx-auto space-y-6">

        <!-- ==========================================
             1. CABECERA & NAVEGACIÓN
             ========================================== -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-slate-200/80 dark:border-slate-800 pb-5">
            <div class="flex items-center gap-3">
                <a href="/public" class="inline-flex items-center justify-center w-10 h-10 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition shadow-xs" title="Volver al inicio">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-950/60 dark:text-amber-300 border border-amber-200 dark:border-amber-800">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                        </svg>
                        Módulo Jurídico & Derechos
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-1">
                        Evaluación de Derechos en Salud
                    </h1>
                </div>
            </div>

            <!-- Progreso general badge -->
            <div class="flex items-center gap-3 bg-white dark:bg-slate-800 p-2.5 px-4 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-xs">
                <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center font-bold text-sm" id="progressPercentBadge">
                    0%
                </div>
                <div>
                    <p class="text-[11px] uppercase tracking-wider font-semibold text-slate-400">Progreso Total</p>
                    <p class="text-xs font-bold text-slate-700 dark:text-slate-200" id="progressStepText">Sección 1 de 6</p>
                </div>
            </div>
        </div>

        <?php if ($encuestaHabilitada == 1): ?>
            <!-- ==========================================
                 ESTADO: ENCUESTA YA COMPLETADA (BLOQUEADA)
                 ========================================== -->
            <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-3xl p-8 sm:p-12 text-center max-w-2xl mx-auto shadow-sm">
                <div class="w-20 h-20 mx-auto rounded-3xl bg-amber-50 dark:bg-amber-950/50 text-amber-500 border border-amber-200 dark:border-amber-800 flex items-center justify-center mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">
                    ¡Ya has completado esta encuesta!
                </h2>
                <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-8 max-w-lg mx-auto">
                    Tus respuestas han sido registradas y están disponibles para el equipo de profesionales. En este momento tu encuesta se encuentra en periodo de seguimiento. Cuando corresponda una nueva toma o tu asesor la re-habilite, podrás responderla nuevamente.
                </p>
                <div class="flex flex-wrap items-center justify-center gap-3">
                    <a href="/public" class="px-5 py-2.5 rounded-xl font-semibold text-sm text-white bg-amber-600 hover:bg-amber-700 transition shadow-xs">
                        Ir al Inicio
                    </a>
                    <a href="/public/citas" class="px-5 py-2.5 rounded-xl font-semibold text-sm text-slate-700 dark:text-slate-200 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 transition">
                        Ver mis Citas
                    </a>
                </div>
            </div>

            <!-- Modal Flowbite por compatibilidad -->
            <div id="modalEl" tabindex="-1" aria-hidden="true" class="hidden"></div>
        <?php else: ?>

            <!-- ==========================================
                 BARRA DE PROGRESO Y PASOS
                 ========================================== -->
            <div class="bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700/80 rounded-2xl p-4 shadow-xs">
                <div class="flex items-center justify-between text-xs font-semibold text-slate-600 dark:text-slate-300 mb-2">
                    <span id="labelSeccionActiva">Sección 1: Derechos Fundamentales en Salud</span>
                    <span id="contadorRespondidas" class="text-amber-600 dark:text-amber-400 font-bold">0 de 26 respondidas</span>
                </div>
                <div class="w-full bg-slate-100 dark:bg-slate-700 h-2.5 rounded-full overflow-hidden">
                    <div id="progressBarFill" class="bg-gradient-to-r from-amber-500 to-yellow-400 h-2.5 rounded-full transition-all duration-300" style="width: 16.66%;"></div>
                </div>

                <!-- Pasos Pills -->
                <div class="flex items-center justify-between gap-1 mt-4 overflow-x-auto pb-1" id="stepPillsContainer">
                    <button type="button" class="step-pill active" data-step="0">1. Fundamentales</button>
                    <button type="button" class="step-pill" data-step="1">2. Acceso Salud</button>
                    <button type="button" class="step-pill" data-step="2">3. Petición</button>
                    <button type="button" class="step-pill" data-step="3">4. Trámites</button>
                    <button type="button" class="step-pill" data-step="4">5. Tutela</button>
                    <button type="button" class="step-pill" data-step="5">6. Dignidad</button>
                </div>
            </div>

            <!-- Guía de Escala Likert Rápida -->
            <div class="bg-amber-500/5 dark:bg-amber-500/10 border border-amber-200/60 dark:border-amber-800/60 rounded-2xl p-4 text-xs">
                <div class="flex items-center gap-2 mb-2 font-bold text-slate-800 dark:text-slate-200">
                    <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    ¿Cómo responder? Selecciona con qué frecuencia se te ha presentado cada dificultad:
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                    <div class="flex items-center gap-2 bg-white dark:bg-slate-800 p-2 rounded-xl border border-slate-200 dark:border-slate-700">
                        <span class="w-3 h-3 rounded-full bg-emerald-500 shrink-0"></span>
                        <span class="font-semibold text-slate-700 dark:text-slate-300">Nunca</span>
                        <span class="text-slate-400 text-[10px] ml-auto">Sin dificultad</span>
                    </div>
                    <div class="flex items-center gap-2 bg-white dark:bg-slate-800 p-2 rounded-xl border border-slate-200 dark:border-slate-700">
                        <span class="w-3 h-3 rounded-full bg-amber-500 shrink-0"></span>
                        <span class="font-semibold text-slate-700 dark:text-slate-300">Pocas veces</span>
                        <span class="text-slate-400 text-[10px] ml-auto">Ocasional</span>
                    </div>
                    <div class="flex items-center gap-2 bg-white dark:bg-slate-800 p-2 rounded-xl border border-slate-200 dark:border-slate-700">
                        <span class="w-3 h-3 rounded-full bg-orange-500 shrink-0"></span>
                        <span class="font-semibold text-slate-700 dark:text-slate-300">Frecuentemente</span>
                        <span class="text-slate-400 text-[10px] ml-auto">Recurrente</span>
                    </div>
                    <div class="flex items-center gap-2 bg-white dark:bg-slate-800 p-2 rounded-xl border border-slate-200 dark:border-slate-700">
                        <span class="w-3 h-3 rounded-full bg-rose-500 shrink-0"></span>
                        <span class="font-semibold text-slate-700 dark:text-slate-300">Siempre</span>
                        <span class="text-slate-400 text-[10px] ml-auto">Constante</span>
                    </div>
                </div>
            </div>

            <!-- ==========================================
                 FORMULARIO DE EVALUACIÓN
                 ========================================== -->
            <form method="POST" id="formEncuestaJuridica" class="space-y-6">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

                    <!-- Columna Izquierda: Ilustración & Pregunta Guía -->
                    <div class="lg:col-span-4 bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700/80 rounded-3xl p-6 shadow-xs lg:sticky lg:top-24 space-y-4">
                        <div class="text-center">
                            <span class="inline-block px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-amber-50 text-amber-700 dark:bg-amber-950/60 dark:text-amber-300 border border-amber-200 dark:border-amber-800 mb-2" id="seccionBadgeIndex">
                                Pregunta Guía
                            </span>
                            <h3 id="preguntaGuiaTexto" class="text-base font-bold text-slate-900 dark:text-white leading-snug">
                                He tenido dificultades al comprender cuáles son mis derechos fundamentales en salud, por:
                            </h3>
                        </div>

                        <!-- Ilustración Dinámica -->
                        <div class="relative w-full h-48 sm:h-56 rounded-2xl bg-amber-50/50 dark:bg-slate-750 flex items-center justify-center overflow-hidden border border-amber-100 dark:border-slate-700">
                            <img id="seccionIlustracion" src="/public/build/img/derecho1.png" alt="Ilustración sección" class="max-h-48 object-contain transition-all duration-300 transform hover:scale-105">
                        </div>

                        <div class="text-xs text-slate-500 dark:text-slate-400 text-center leading-relaxed">
                            Responde cada uno de los ítems a la derecha seleccionando la opción que mejor refleje tu experiencia reciente.
                        </div>
                    </div>

                    <!-- Columna Derecha: Tarjetas de Preguntas por Sección -->
                    <div class="lg:col-span-8 space-y-4">

                        <!-- SECCIÓN 0: Derechos Fundamentales (fundamental 1..4) -->
                        <div class="seccion-preguntas space-y-4" data-step="0">
                            <?php
                            $itemsFundamentales = [
                                1 => 'Falta de conocimiento sobre cuáles son mis derechos fundamentales en salud',
                                2 => 'Dificultades económicas para acceder a asesoría legal especializada',
                                3 => 'Falta de apoyo o acompañamiento de un grupo asesor o profesional',
                                4 => 'Falta de apoyo o respuesta de organismos de control y/o entes territoriales'
                            ];
                            foreach ($itemsFundamentales as $idx => $txt):
                            ?>
                                <div class="tarjeta-item bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700/80 rounded-2xl p-5 shadow-xs transition hover:border-amber-400 dark:hover:border-amber-500" data-respondida="false">
                                    <div class="flex items-start justify-between gap-3 mb-3">
                                        <div class="flex items-center gap-2">
                                            <span class="w-6 h-6 rounded-lg bg-amber-500/10 text-amber-600 dark:text-amber-400 text-xs font-bold flex items-center justify-center shrink-0">1.<?= $idx ?></span>
                                            <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-200"><?= htmlspecialchars($txt) ?></h4>
                                        </div>
                                        <span class="badge-estado text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-500 dark:bg-slate-750 dark:text-slate-400 shrink-0">Pendiente</span>
                                    </div>
                                    <input type="hidden" name="fundamental[<?= $idx ?>]" class="input-likert" value="50" required>
                                    <div class="opciones-likert grid grid-cols-2 sm:grid-cols-4 gap-2">
                                        <button type="button" class="btn-likert" data-valor="12" data-color="emerald">
                                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Nunca
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="38" data-color="amber">
                                            <span class="w-2 h-2 rounded-full bg-amber-500"></span> Pocas veces
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="63" data-color="orange">
                                            <span class="w-2 h-2 rounded-full bg-orange-500"></span> Frecuente
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="88" data-color="rose">
                                            <span class="w-2 h-2 rounded-full bg-rose-500"></span> Siempre
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- SECCIÓN 1: Acceso a la Salud (salud 1..4) -->
                        <div class="seccion-preguntas space-y-4 hidden" data-step="1">
                            <?php
                            $itemsSalud = [
                                1 => 'Falta de conocimiento sobre los servicios a los que tengo derecho',
                                2 => 'Falta de cobertura en el Plan de Beneficios en Salud (PBS)',
                                3 => 'Falta de conocimiento en la Ruta de Atención médica correspondiente',
                                4 => 'Falta de apoyo institucional de la entidad prestadora de salud'
                            ];
                            foreach ($itemsSalud as $idx => $txt):
                            ?>
                                <div class="tarjeta-item bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700/80 rounded-2xl p-5 shadow-xs transition hover:border-amber-400 dark:hover:border-amber-500" data-respondida="false">
                                    <div class="flex items-start justify-between gap-3 mb-3">
                                        <div class="flex items-center gap-2">
                                            <span class="w-6 h-6 rounded-lg bg-amber-500/10 text-amber-600 dark:text-amber-400 text-xs font-bold flex items-center justify-center shrink-0">2.<?= $idx ?></span>
                                            <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-200"><?= htmlspecialchars($txt) ?></h4>
                                        </div>
                                        <span class="badge-estado text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-500 dark:bg-slate-750 dark:text-slate-400 shrink-0">Pendiente</span>
                                    </div>
                                    <input type="hidden" name="salud[<?= $idx ?>]" class="input-likert" value="50" required>
                                    <div class="opciones-likert grid grid-cols-2 sm:grid-cols-4 gap-2">
                                        <button type="button" class="btn-likert" data-valor="12" data-color="emerald">
                                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Nunca
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="38" data-color="amber">
                                            <span class="w-2 h-2 rounded-full bg-amber-500"></span> Pocas veces
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="63" data-color="orange">
                                            <span class="w-2 h-2 rounded-full bg-orange-500"></span> Frecuente
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="88" data-color="rose">
                                            <span class="w-2 h-2 rounded-full bg-rose-500"></span> Siempre
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- SECCIÓN 2: Derecho de Petición (peticion 1..4) -->
                        <div class="seccion-preguntas space-y-4 hidden" data-step="2">
                            <?php
                            $itemsPeticion = [
                                1 => 'Falta de conocimiento de cómo redactar o estructurar un Derecho de Petición',
                                2 => 'Dificultades económicas para acceder a asesoría en la elaboración',
                                3 => 'Falta de conocimiento en la ruta y canales de radicación oficial',
                                4 => 'Demoras o lentitud en los tiempos de respuesta de la entidad'
                            ];
                            foreach ($itemsPeticion as $idx => $txt):
                            ?>
                                <div class="tarjeta-item bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700/80 rounded-2xl p-5 shadow-xs transition hover:border-amber-400 dark:hover:border-amber-500" data-respondida="false">
                                    <div class="flex items-start justify-between gap-3 mb-3">
                                        <div class="flex items-center gap-2">
                                            <span class="w-6 h-6 rounded-lg bg-amber-500/10 text-amber-600 dark:text-amber-400 text-xs font-bold flex items-center justify-center shrink-0">3.<?= $idx ?></span>
                                            <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-200"><?= htmlspecialchars($txt) ?></h4>
                                        </div>
                                        <span class="badge-estado text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-500 dark:bg-slate-750 dark:text-slate-400 shrink-0">Pendiente</span>
                                    </div>
                                    <input type="hidden" name="peticion[<?= $idx ?>]" class="input-likert" value="50" required>
                                    <div class="opciones-likert grid grid-cols-2 sm:grid-cols-4 gap-2">
                                        <button type="button" class="btn-likert" data-valor="12" data-color="emerald">
                                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Nunca
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="38" data-color="amber">
                                            <span class="w-2 h-2 rounded-full bg-amber-500"></span> Pocas veces
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="63" data-color="orange">
                                            <span class="w-2 h-2 rounded-full bg-orange-500"></span> Frecuente
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="88" data-color="rose">
                                            <span class="w-2 h-2 rounded-full bg-rose-500"></span> Siempre
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- SECCIÓN 3: Trámite Administrativo (proceso 1..5) -->
                        <div class="seccion-preguntas space-y-4 hidden" data-step="3">
                            <?php
                            $itemsProceso = [
                                1 => 'Falta de conocimiento sobre los trámites administrativos requeridos en salud',
                                2 => 'Dificultades y trabas en la atención directa al usuario',
                                3 => 'Falta de apoyo o acompañamiento en la asesoría jurídica del trámite',
                                4 => 'Dificultades en el término y cumplimiento de plazos de respuesta',
                                5 => 'Dificultades en trámites de PQR ante la Superintendencia Nacional de Salud'
                            ];
                            foreach ($itemsProceso as $idx => $txt):
                            ?>
                                <div class="tarjeta-item bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700/80 rounded-2xl p-5 shadow-xs transition hover:border-amber-400 dark:hover:border-amber-500" data-respondida="false">
                                    <div class="flex items-start justify-between gap-3 mb-3">
                                        <div class="flex items-center gap-2">
                                            <span class="w-6 h-6 rounded-lg bg-amber-500/10 text-amber-600 dark:text-amber-400 text-xs font-bold flex items-center justify-center shrink-0">4.<?= $idx ?></span>
                                            <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-200"><?= htmlspecialchars($txt) ?></h4>
                                        </div>
                                        <span class="badge-estado text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-500 dark:bg-slate-750 dark:text-slate-400 shrink-0">Pendiente</span>
                                    </div>
                                    <input type="hidden" name="proceso[<?= $idx ?>]" class="input-likert" value="50" required>
                                    <div class="opciones-likert grid grid-cols-2 sm:grid-cols-4 gap-2">
                                        <button type="button" class="btn-likert" data-valor="12" data-color="emerald">
                                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Nunca
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="38" data-color="amber">
                                            <span class="w-2 h-2 rounded-full bg-amber-500"></span> Pocas veces
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="63" data-color="orange">
                                            <span class="w-2 h-2 rounded-full bg-orange-500"></span> Frecuente
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="88" data-color="rose">
                                            <span class="w-2 h-2 rounded-full bg-rose-500"></span> Siempre
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- SECCIÓN 4: Acción de Tutela (tutela 1..4) -->
                        <div class="seccion-preguntas space-y-4 hidden" data-step="4">
                            <?php
                            $itemsTutela = [
                                1 => 'Falta de conocimiento sobre el funcionamiento y alcances de la Acción de Tutela',
                                2 => 'Dificultades económicas para acceder a asesoría legal',
                                3 => 'Falta de conocimiento en la ruta de trámite y juzgados competentes',
                                4 => 'Falta de apoyo de entidades públicas (Personería, Defensoría, Alcaldía)'
                            ];
                            foreach ($itemsTutela as $idx => $txt):
                            ?>
                                <div class="tarjeta-item bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700/80 rounded-2xl p-5 shadow-xs transition hover:border-amber-400 dark:hover:border-amber-500" data-respondida="false">
                                    <div class="flex items-start justify-between gap-3 mb-3">
                                        <div class="flex items-center gap-2">
                                            <span class="w-6 h-6 rounded-lg bg-amber-500/10 text-amber-600 dark:text-amber-400 text-xs font-bold flex items-center justify-center shrink-0">5.<?= $idx ?></span>
                                            <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-200"><?= htmlspecialchars($txt) ?></h4>
                                        </div>
                                        <span class="badge-estado text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-500 dark:bg-slate-750 dark:text-slate-400 shrink-0">Pendiente</span>
                                    </div>
                                    <input type="hidden" name="tutela[<?= $idx ?>]" class="input-likert" value="50" required>
                                    <div class="opciones-likert grid grid-cols-2 sm:grid-cols-4 gap-2">
                                        <button type="button" class="btn-likert" data-valor="12" data-color="emerald">
                                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Nunca
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="38" data-color="amber">
                                            <span class="w-2 h-2 rounded-full bg-amber-500"></span> Pocas veces
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="63" data-color="orange">
                                            <span class="w-2 h-2 rounded-full bg-orange-500"></span> Frecuente
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="88" data-color="rose">
                                            <span class="w-2 h-2 rounded-full bg-rose-500"></span> Siempre
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- SECCIÓN 5: Dignidad Humana (dignidad 1..5) -->
                        <div class="seccion-preguntas space-y-4 hidden" data-step="5">
                            <?php
                            $itemsDignidad = [
                                1 => 'Trato poco digno, irrespetuoso o insensible por parte de funcionarios de la salud',
                                2 => 'Demoras o negación en el suministro oportuno de materiales e insumos médicos',
                                3 => 'Dificultades en el suministro continuo de medicamentos para mi tratamiento',
                                4 => 'Dificultades para acceder a consultas con médicos especialistas',
                                5 => 'Falta de acompañamiento emocional y psicológico para mí y mi familia'
                            ];
                            foreach ($itemsDignidad as $idx => $txt):
                            ?>
                                <div class="tarjeta-item bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700/80 rounded-2xl p-5 shadow-xs transition hover:border-amber-400 dark:hover:border-amber-500" data-respondida="false">
                                    <div class="flex items-start justify-between gap-3 mb-3">
                                        <div class="flex items-center gap-2">
                                            <span class="w-6 h-6 rounded-lg bg-amber-500/10 text-amber-600 dark:text-amber-400 text-xs font-bold flex items-center justify-center shrink-0">6.<?= $idx ?></span>
                                            <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-200"><?= htmlspecialchars($txt) ?></h4>
                                        </div>
                                        <span class="badge-estado text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-500 dark:bg-slate-750 dark:text-slate-400 shrink-0">Pendiente</span>
                                    </div>
                                    <input type="hidden" name="dignidad[<?= $idx ?>]" class="input-likert" value="50" required>
                                    <div class="opciones-likert grid grid-cols-2 sm:grid-cols-4 gap-2">
                                        <button type="button" class="btn-likert" data-valor="12" data-color="emerald">
                                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Nunca
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="38" data-color="amber">
                                            <span class="w-2 h-2 rounded-full bg-amber-500"></span> Pocas veces
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="63" data-color="orange">
                                            <span class="w-2 h-2 rounded-full bg-orange-500"></span> Frecuente
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="88" data-color="rose">
                                            <span class="w-2 h-2 rounded-full bg-rose-500"></span> Siempre
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>

                <!-- ==========================================
                     BARRA INFERIOR DE ACCIONES & NAVEGACIÓN
                     ========================================== -->
                <div class="bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700/80 rounded-2xl p-4 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
                    <button type="button" id="btnPasoAnterior" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl font-semibold text-sm text-slate-700 dark:text-slate-300 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-650 transition disabled:opacity-40 disabled:cursor-not-allowed" disabled>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Sección Anterior
                    </button>

                    <div class="text-xs text-slate-500 dark:text-slate-400 font-medium text-center">
                        <span id="seccionProgresoActual" class="font-bold text-amber-600 dark:text-amber-400">0 de 4</span> respondidas en esta sección
                    </div>

                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <button type="button" id="btnPasoSiguiente" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl font-semibold text-sm text-white bg-amber-600 hover:bg-amber-700 transition shadow-xs">
                            Siguiente Sección
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                        <button type="submit" id="btnFinalizarEncuesta" name="finalizar" class="hidden w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-2.5 rounded-xl font-bold text-sm text-white bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 transition shadow-md shadow-emerald-500/20 animate-pulse">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Finalizar y Enviar
                        </button>
                    </div>
                </div>
            </form>
        <?php endif; ?>

    </div>
</main>

<style>
/* Estilos para los botones de opción Likert */
.btn-likert {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.375rem;
    padding: 0.625rem 0.75rem;
    border-radius: 0.75rem;
    font-size: 0.75rem;
    font-weight: 600;
    border: 1.5px solid #e2e8f0;
    background-color: #f8fafc;
    color: #475569;
    cursor: pointer;
    transition: all 0.15s ease-in-out;
}
.dark .btn-likert {
    border-color: #334155;
    background-color: #1e293b;
    color: #cbd5e1;
}
.btn-likert:hover {
    border-color: #cbd5e1;
    background-color: #ffffff;
    transform: translateY(-1px);
}
.dark .btn-likert:hover {
    border-color: #475569;
    background-color: #243044;
}

/* Opciones seleccionadas según color */
.btn-likert.selected[data-color="emerald"] {
    border-color: #10b981 !important;
    background-color: #ecfdf5 !important;
    color: #065f46 !important;
    box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
}
.dark .btn-likert.selected[data-color="emerald"] {
    background-color: rgba(6, 78, 59, 0.4) !important;
    color: #6ee7b7 !important;
}

.btn-likert.selected[data-color="amber"] {
    border-color: #f59e0b !important;
    background-color: #fffbeb !important;
    color: #92400e !important;
    box-shadow: 0 0 0 2px rgba(245, 158, 11, 0.2);
}
.dark .btn-likert.selected[data-color="amber"] {
    background-color: rgba(120, 53, 15, 0.4) !important;
    color: #fcd34d !important;
}

.btn-likert.selected[data-color="orange"] {
    border-color: #f97316 !important;
    background-color: #fff7ed !important;
    color: #9a3412 !important;
    box-shadow: 0 0 0 2px rgba(249, 115, 22, 0.2);
}
.dark .btn-likert.selected[data-color="orange"] {
    background-color: rgba(124, 45, 18, 0.4) !important;
    color: #fdba74 !important;
}

.btn-likert.selected[data-color="rose"] {
    border-color: #f43f5e !important;
    background-color: #fff1f2 !important;
    color: #9f1239 !important;
    box-shadow: 0 0 0 2px rgba(244, 63, 94, 0.2);
}
.dark .btn-likert.selected[data-color="rose"] {
    background-color: rgba(136, 19, 55, 0.4) !important;
    color: #fda4af !important;
}

/* Pills de navegación de pasos */
.step-pill {
    padding: 0.375rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.7rem;
    font-weight: 700;
    white-space: nowrap;
    border: 1px solid #e2e8f0;
    background-color: #f8fafc;
    color: #64748b;
    transition: all 0.2s;
    cursor: pointer;
}
.dark .step-pill {
    border-color: #334155;
    background-color: #0f172a;
    color: #94a3b8;
}
.step-pill.active {
    background-color: #d97706;
    color: #ffffff;
    border-color: #d97706;
}
.step-pill.completed {
    background-color: #ecfdf5;
    color: #047857;
    border-color: #a7f3d0;
}
.dark .step-pill.completed {
    background-color: rgba(6, 78, 59, 0.3);
    color: #6ee7b7;
    border-color: #065f46;
}
</style>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const totalSecciones = 6;
    let seccionActual = 0;

    const metadataSecciones = [
        {
            titulo: "He tenido dificultades al comprender cuáles son mis derechos fundamentales en salud, por:",
            ilustracion: "/public/build/img/derecho1.png",
            seccionNombre: "Sección 1: Derechos Fundamentales en Salud"
        },
        {
            titulo: "He tenido dificultades en el acceso a la salud, por:",
            ilustracion: "/public/build/img/derecho2.png",
            seccionNombre: "Sección 2: Acceso a los Servicios de Salud"
        },
        {
            titulo: "He tenido dificultades en el trámite de un Derecho de Petición en salud, por:",
            ilustracion: "/public/build/img/derecho3.png",
            seccionNombre: "Sección 3: Derecho de Petición en Salud"
        },
        {
            titulo: "He tenido dificultades en trámites administrativos en salud (dispositivos, citas, etc.), por:",
            ilustracion: "/public/build/img/derecho4.png",
            seccionNombre: "Sección 4: Trámites Administrativos y Reclamos"
        },
        {
            titulo: "He tenido dificultades en el mecanismo de protección mediante Acción de Tutela, por:",
            ilustracion: "/public/build/img/derecho5.png",
            seccionNombre: "Sección 5: Mecanismo de Acción de Tutela"
        },
        {
            titulo: "He tenido dificultades en la protección a mi dignidad humana por entidades de salud, por:",
            ilustracion: "/public/build/img/derecho5.png",
            seccionNombre: "Sección 6: Protección a la Dignidad Humana"
        }
    ];

    const seccionesEls = document.querySelectorAll(".seccion-preguntas");
    const stepPills = document.querySelectorAll(".step-pill");
    const btnAnterior = document.getElementById("btnPasoAnterior");
    const btnSiguiente = document.getElementById("btnPasoSiguiente");
    const btnFinalizar = document.getElementById("btnFinalizarEncuesta");
    const labelSeccionActiva = document.getElementById("labelSeccionActiva");
    const progressBarFill = document.getElementById("progressBarFill");
    const progressPercentBadge = document.getElementById("progressPercentBadge");
    const progressStepText = document.getElementById("progressStepText");
    const seccionProgresoActual = document.getElementById("seccionProgresoActual");
    const contadorRespondidas = document.getElementById("contadorRespondidas");
    const preguntaGuiaTexto = document.getElementById("preguntaGuiaTexto");
    const seccionIlustracion = document.getElementById("seccionIlustracion");
    const seccionBadgeIndex = document.getElementById("seccionBadgeIndex");

    // Click en opciones Likert
    document.querySelectorAll(".tarjeta-item").forEach(tarjeta => {
        const inputHidden = tarjeta.querySelector(".input-likert");
        const badge = tarjeta.querySelector(".badge-estado");
        const botones = tarjeta.querySelectorAll(".btn-likert");

        botones.forEach(btn => {
            btn.addEventListener("click", () => {
                botones.forEach(b => b.classList.remove("selected"));
                btn.classList.add("selected");
                inputHidden.value = btn.getAttribute("data-valor");
                tarjeta.setAttribute("data-respondida", "true");

                // Actualizar badge del item
                badge.textContent = "✓ Respondida";
                badge.className = "badge-estado text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-300 shrink-0";

                actualizarProgreso();
            });
        });
    });

    function actualizarProgreso() {
        const todosLosItems = document.querySelectorAll(".tarjeta-item");
        let totalRespondidas = 0;
        todosLosItems.forEach(item => {
            if (item.getAttribute("data-respondida") === "true") totalRespondidas++;
        });

        const porcentaje = Math.round((totalRespondidas / todosLosItems.length) * 100);
        if (progressBarFill) progressBarFill.style.width = Math.max(porcentaje, 16) + "%";
        if (progressPercentBadge) progressPercentBadge.textContent = porcentaje + "%";
        if (contadorRespondidas) contadorRespondidas.textContent = `${totalRespondidas} de ${todosLosItems.length} respondidas`;

        // Conteo en sección activa
        const seccionActivaEl = document.querySelector(`.seccion-preguntas[data-step="${seccionActual}"]`);
        if (seccionActivaEl) {
            const itemsEnSeccion = seccionActivaEl.querySelectorAll(".tarjeta-item");
            let respondidasEnSeccion = 0;
            itemsEnSeccion.forEach(item => {
                if (item.getAttribute("data-respondida") === "true") respondidasEnSeccion++;
            });
            if (seccionProgresoActual) seccionProgresoActual.textContent = `${respondidasEnSeccion} de ${itemsEnSeccion.length}`;

            // Marcar pill de paso como completado
            const pill = document.querySelector(`.step-pill[data-step="${seccionActual}"]`);
            if (pill && respondidasEnSeccion === itemsEnSeccion.length) {
                pill.classList.add("completed");
            }
        }
    }

    function mostrarSeccion(indice) {
        if (indice < 0 || indice >= totalSecciones) return;
        seccionActual = indice;

        seccionesEls.forEach((sec, i) => {
            sec.classList.toggle("hidden", i !== seccionActual);
        });

        stepPills.forEach((p, i) => {
            p.classList.toggle("active", i === seccionActual);
        });

        // Actualizar textos e imagen guía
        const meta = metadataSecciones[seccionActual];
        if (meta) {
            if (preguntaGuiaTexto) preguntaGuiaTexto.textContent = meta.titulo;
            if (seccionIlustracion) seccionIlustracion.src = meta.ilustracion;
            if (labelSeccionActiva) labelSeccionActiva.textContent = meta.seccionNombre;
            if (seccionBadgeIndex) seccionBadgeIndex.textContent = `Sección ${seccionActual + 1} de ${totalSecciones}`;
            if (progressStepText) progressStepText.textContent = `Sección ${seccionActual + 1} de ${totalSecciones}`;
        }

        // Botones de navegación
        if (btnAnterior) btnAnterior.disabled = (seccionActual === 0);

        if (seccionActual === totalSecciones - 1) {
            if (btnSiguiente) btnSiguiente.classList.add("hidden");
            if (btnFinalizar) btnFinalizar.classList.remove("hidden");
        } else {
            if (btnSiguiente) btnSiguiente.classList.remove("hidden");
            if (btnFinalizar) btnFinalizar.classList.add("hidden");
        }

        actualizarProgreso();
        window.scrollTo({ top: 100, behavior: 'smooth' });
    }

    // Navegación de botones
    if (btnAnterior) {
        btnAnterior.addEventListener("click", () => {
            if (seccionActual > 0) mostrarSeccion(seccionActual - 1);
        });
    }

    if (btnSiguiente) {
        btnSiguiente.addEventListener("click", () => {
            // Verificar si faltan preguntas en esta sección
            const seccionActivaEl = document.querySelector(`.seccion-preguntas[data-step="${seccionActual}"]`);
            const pendientes = seccionActivaEl ? seccionActivaEl.querySelectorAll('.tarjeta-item[data-respondida="false"]') : [];
            
            if (pendientes.length > 0) {
                // Destacar primera pendiente
                const primeraPendiente = pendientes[0];
                primeraPendiente.scrollIntoView({ behavior: 'smooth', block: 'center' });
                primeraPendiente.classList.add("ring-2", "ring-rose-500", "animate-pulse");
                setTimeout(() => primeraPendiente.classList.remove("ring-2", "ring-rose-500", "animate-pulse"), 1500);
                return;
            }

            if (seccionActual < totalSecciones - 1) {
                mostrarSeccion(seccionActual + 1);
            }
        });
    }

    // Click en pills directas
    stepPills.forEach(pill => {
        pill.addEventListener("click", () => {
            const paso = parseInt(pill.getAttribute("data-step"), 10);
            mostrarSeccion(paso);
        });
    });

    // Envío del formulario
    const form = document.getElementById("formEncuestaJuridica");
    if (form) {
        form.addEventListener("submit", (e) => {
            const noRespondidas = document.querySelectorAll('.tarjeta-item[data-respondida="false"]');
            if (noRespondidas.length > 0) {
                e.preventDefault();
                alert(`Aún tienes ${noRespondidas.length} preguntas sin responder en la encuesta. Por favor complétalas para poder enviar tu evaluación.`);
                noRespondidas[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    }

    // Inicializar
    mostrarSeccion(0);
});
</script>