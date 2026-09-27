<?php
$encuestaHabilitada = intval($encuestaHabilitada ?? 0);
?>
<main class="min-h-screen pt-24 pb-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-slate-50 via-indigo-50/20 to-slate-50 dark:from-slate-900 dark:via-slate-850 dark:to-slate-900 transition-colors">
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
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-800 dark:bg-indigo-950/60 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-800">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Módulo Psicológico & Emocional
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white mt-1">
                        Evaluación de Bienestar Emocional
                    </h1>
                </div>
            </div>

            <!-- Progreso general badge -->
            <div class="flex items-center gap-3 bg-white dark:bg-slate-800 p-2.5 px-4 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-xs">
                <div class="w-10 h-10 rounded-xl bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center font-bold text-sm" id="progressPercentBadge">
                    0%
                </div>
                <div>
                    <p class="text-[11px] uppercase tracking-wider font-semibold text-slate-400">Progreso Total</p>
                    <p class="text-xs font-bold text-slate-700 dark:text-slate-200" id="progressStepText">Sección 1 de 4</p>
                </div>
            </div>
        </div>

        <?php if ($encuestaHabilitada == 1): ?>
            <!-- ==========================================
                 ESTADO: ENCUESTA YA COMPLETADA (BLOQUEADA)
                 ========================================== -->
            <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-3xl p-8 sm:p-12 text-center max-w-2xl mx-auto shadow-sm">
                <div class="w-20 h-20 mx-auto rounded-3xl bg-indigo-50 dark:bg-indigo-950/50 text-indigo-500 border border-indigo-200 dark:border-indigo-800 flex items-center justify-center mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">
                    ¡Ya has completado esta encuesta!
                </h2>
                <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-8 max-w-lg mx-auto">
                    Tus respuestas han sido recibidas confidencialmente por el profesional de psicología para brindarte una orientación adecuada. En este momento tu encuesta se encuentra completada. Cuando corresponda una nueva toma o tu psicólogo la reactive, podrás responderla nuevamente.
                </p>
                <div class="flex flex-wrap items-center justify-center gap-3">
                    <a href="/public" class="px-5 py-2.5 rounded-xl font-semibold text-sm text-white bg-indigo-600 hover:bg-indigo-700 transition shadow-xs">
                        Ir al Inicio
                    </a>
                    <a href="/public/citas" class="px-5 py-2.5 rounded-xl font-semibold text-sm text-slate-700 dark:text-slate-200 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 transition">
                        Ver mis Citas
                    </a>
                </div>
            </div>

            <div id="modalEl" tabindex="-1" aria-hidden="true" class="hidden"></div>
        <?php else: ?>

            <!-- ==========================================
                 BARRA DE PROGRESO Y PASOS
                 ========================================== -->
            <div class="bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700/80 rounded-2xl p-4 shadow-xs">
                <div class="flex items-center justify-between text-xs font-semibold text-slate-600 dark:text-slate-300 mb-2">
                    <span id="labelSeccionActiva">Sección 1: Estados de Ánimo (Ítems 1 al 4)</span>
                    <span id="contadorRespondidas" class="text-indigo-600 dark:text-indigo-400 font-bold">0 de 16 respondidas</span>
                </div>
                <div class="w-full bg-slate-100 dark:bg-slate-700 h-2.5 rounded-full overflow-hidden">
                    <div id="progressBarFill" class="bg-gradient-to-r from-indigo-500 to-violet-500 h-2.5 rounded-full transition-all duration-300" style="width: 25%;"></div>
                </div>

                <!-- Pasos Pills -->
                <div class="flex items-center justify-between gap-1 mt-4 overflow-x-auto pb-1" id="stepPillsContainer">
                    <button type="button" class="step-pill active" data-step="0">1. Fase Inicial (1-4)</button>
                    <button type="button" class="step-pill" data-step="1">2. Estado Actual (5-8)</button>
                    <button type="button" class="step-pill" data-step="2">3. Sentimientos (9-12)</button>
                    <button type="button" class="step-pill" data-step="3">4. Cierre Emocional (13-16)</button>
                </div>
            </div>

            <!-- Guía de Escala Likert Rápida -->
            <div class="bg-indigo-500/5 dark:bg-indigo-500/10 border border-indigo-200/60 dark:border-indigo-800/60 rounded-2xl p-4 text-xs">
                <div class="flex items-center gap-2 mb-2 font-bold text-slate-800 dark:text-slate-200">
                    <svg class="w-4 h-4 text-indigo-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    ¿Cómo responder? Selecciona con qué frecuencia has experimentado cada emoción o estado recientemente:
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                    <div class="flex items-center gap-2 bg-white dark:bg-slate-800 p-2 rounded-xl border border-slate-200 dark:border-slate-700">
                        <span class="w-3 h-3 rounded-full bg-emerald-500 shrink-0"></span>
                        <span class="font-semibold text-slate-700 dark:text-slate-300">Nunca</span>
                        <span class="text-slate-400 text-[10px] ml-auto">Casi nunca (1)</span>
                    </div>
                    <div class="flex items-center gap-2 bg-white dark:bg-slate-800 p-2 rounded-xl border border-slate-200 dark:border-slate-700">
                        <span class="w-3 h-3 rounded-full bg-amber-500 shrink-0"></span>
                        <span class="font-semibold text-slate-700 dark:text-slate-300">Pocas veces</span>
                        <span class="text-slate-400 text-[10px] ml-auto">A veces (2)</span>
                    </div>
                    <div class="flex items-center gap-2 bg-white dark:bg-slate-800 p-2 rounded-xl border border-slate-200 dark:border-slate-700">
                        <span class="w-3 h-3 rounded-full bg-orange-500 shrink-0"></span>
                        <span class="font-semibold text-slate-700 dark:text-slate-300">Frecuentemente</span>
                        <span class="text-slate-400 text-[10px] ml-auto">A menudo (3)</span>
                    </div>
                    <div class="flex items-center gap-2 bg-white dark:bg-slate-800 p-2 rounded-xl border border-slate-200 dark:border-slate-700">
                        <span class="w-3 h-3 rounded-full bg-rose-500 shrink-0"></span>
                        <span class="font-semibold text-slate-700 dark:text-slate-300">Siempre</span>
                        <span class="text-slate-400 text-[10px] ml-auto">Casi siempre (4)</span>
                    </div>
                </div>
            </div>

            <!-- ==========================================
                 FORMULARIO DE EVALUACIÓN
                 ========================================== -->
            <form method="POST" id="formEncuestaPsicologia" class="space-y-6">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

                    <!-- Columna Izquierda: Ilustración & Pregunta Guía -->
                    <div class="lg:col-span-4 bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700/80 rounded-3xl p-6 shadow-xs lg:sticky lg:top-24 space-y-4">
                        <div class="text-center">
                            <span class="inline-block px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-indigo-50 text-indigo-700 dark:bg-indigo-950/60 dark:text-indigo-300 border border-indigo-200 dark:border-indigo-800 mb-2" id="seccionBadgeIndex">
                                Pregunta Guía
                            </span>
                            <h3 id="preguntaGuiaTexto" class="text-base font-bold text-slate-900 dark:text-white leading-snug">
                                A continuación encontrarás frases que describen sentimientos y estados de ánimo:
                            </h3>
                        </div>

                        <!-- Ilustración Dinámica -->
                        <div class="relative w-full h-48 sm:h-56 rounded-2xl bg-indigo-50/50 dark:bg-slate-750 flex items-center justify-center overflow-hidden border border-indigo-100 dark:border-slate-700">
                            <img id="seccionIlustracion" src="/public/build/img/preguntaspsicología1.png" alt="Ilustración sección" class="max-h-48 object-contain transition-all duration-300 transform hover:scale-105">
                        </div>

                        <div class="text-xs text-slate-500 dark:text-slate-400 text-center leading-relaxed">
                            Responde con honestidad según cómo te has sentido en las últimas dos semanas. No existen respuestas correctas o incorrectas.
                        </div>
                    </div>

                    <!-- Columna Derecha: Tarjetas de Preguntas por Sección -->
                    <div class="lg:col-span-8 space-y-4">

                        <!-- SECCIÓN 0: Ítems 1 al 4 -->
                        <div class="seccion-preguntas space-y-4" data-step="0">
                            <?php
                            $itemsSeccion1 = [
                                1 => ['nombre' => 'pregunta1', 'txt' => 'Me siento nervioso(a) o inquieto(a)', 'subescala' => 'Ansiedad'],
                                2 => ['nombre' => 'pregunta2', 'txt' => 'Me siento irritado(a) o de mal genio', 'subescala' => 'Hostilidad'],
                                3 => ['nombre' => 'pregunta3', 'txt' => 'Me siento alegre, satisfecho(a) y de buen ánimo', 'subescala' => 'Bienestar'],
                                4 => ['nombre' => 'pregunta4', 'txt' => 'Me siento melancólico(a) o desanimado(a)', 'subescala' => 'Depresión']
                            ];
                            foreach ($itemsSeccion1 as $num => $it):
                            ?>
                                <div class="tarjeta-item bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700/80 rounded-2xl p-5 shadow-xs transition hover:border-indigo-400 dark:hover:border-indigo-500" data-respondida="false">
                                    <div class="flex items-start justify-between gap-3 mb-3">
                                        <div class="flex items-center gap-2">
                                            <span class="w-6 h-6 rounded-lg bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 text-xs font-bold flex items-center justify-center shrink-0">#<?= $num ?></span>
                                            <div>
                                                <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-200"><?= htmlspecialchars($it['txt']) ?></h4>
                                                <span class="text-[10px] text-slate-400 dark:text-slate-500"><?= $it['subescala'] ?></span>
                                            </div>
                                        </div>
                                        <span class="badge-estado text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-500 dark:bg-slate-750 dark:text-slate-400 shrink-0">Pendiente</span>
                                    </div>
                                    <input type="hidden" name="<?= $it['nombre'] ?>" class="input-likert" value="2" required>
                                    <div class="opciones-likert grid grid-cols-2 sm:grid-cols-4 gap-2">
                                        <button type="button" class="btn-likert" data-valor="1" data-color="emerald">
                                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Nunca
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="2" data-color="amber">
                                            <span class="w-2 h-2 rounded-full bg-amber-500"></span> Pocas veces
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="3" data-color="orange">
                                            <span class="w-2 h-2 rounded-full bg-orange-500"></span> Frecuente
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="4" data-color="rose">
                                            <span class="w-2 h-2 rounded-full bg-rose-500"></span> Siempre
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- SECCIÓN 1: Ítems 5 al 8 -->
                        <div class="seccion-preguntas space-y-4 hidden" data-step="1">
                            <?php
                            $itemsSeccion2 = [
                                5 => ['nombre' => 'pregunta5', 'txt' => 'Me siento tenso(a) o bajo presión', 'subescala' => 'Ansiedad'],
                                6 => ['nombre' => 'pregunta6', 'txt' => 'Me siento optimista frente al futuro', 'subescala' => 'Bienestar'],
                                7 => ['nombre' => 'pregunta7', 'txt' => 'Me siento alicaído(a) o con ganas de llorar', 'subescala' => 'Depresión'],
                                8 => ['nombre' => 'pregunta8', 'txt' => 'Me siento enojado(a) o con rabia fácilmente', 'subescala' => 'Hostilidad']
                            ];
                            foreach ($itemsSeccion2 as $num => $it):
                            ?>
                                <div class="tarjeta-item bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700/80 rounded-2xl p-5 shadow-xs transition hover:border-indigo-400 dark:hover:border-indigo-500" data-respondida="false">
                                    <div class="flex items-start justify-between gap-3 mb-3">
                                        <div class="flex items-center gap-2">
                                            <span class="w-6 h-6 rounded-lg bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 text-xs font-bold flex items-center justify-center shrink-0">#<?= $num ?></span>
                                            <div>
                                                <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-200"><?= htmlspecialchars($it['txt']) ?></h4>
                                                <span class="text-[10px] text-slate-400 dark:text-slate-500"><?= $it['subescala'] ?></span>
                                            </div>
                                        </div>
                                        <span class="badge-estado text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-500 dark:bg-slate-750 dark:text-slate-400 shrink-0">Pendiente</span>
                                    </div>
                                    <input type="hidden" name="<?= $it['nombre'] ?>" class="input-likert" value="2" required>
                                    <div class="opciones-likert grid grid-cols-2 sm:grid-cols-4 gap-2">
                                        <button type="button" class="btn-likert" data-valor="1" data-color="emerald">
                                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Nunca
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="2" data-color="amber">
                                            <span class="w-2 h-2 rounded-full bg-amber-500"></span> Pocas veces
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="3" data-color="orange">
                                            <span class="w-2 h-2 rounded-full bg-orange-500"></span> Frecuente
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="4" data-color="rose">
                                            <span class="w-2 h-2 rounded-full bg-rose-500"></span> Siempre
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- SECCIÓN 2: Ítems 9 al 12 -->
                        <div class="seccion-preguntas space-y-4 hidden" data-step="2">
                            <?php
                            $itemsSeccion3 = [
                                9  => ['nombre' => 'pregunta9',  'txt' => 'Me siento ansioso(a) o con preocupaciones constantes', 'subescala' => 'Ansiedad'],
                                10 => ['nombre' => 'pregunta10', 'txt' => 'Me siento apagado(a), sin energía ni interés', 'subescala' => 'Depresión'],
                                11 => ['nombre' => 'pregunta11', 'txt' => 'Me siento molesto(a) o disgustado(a) con los demás', 'subescala' => 'Hostilidad'],
                                12 => ['nombre' => 'pregunta12', 'txt' => 'Me siento jovial, animado(a) y con buen humor', 'subescala' => 'Bienestar']
                            ];
                            foreach ($itemsSeccion3 as $num => $it):
                            ?>
                                <div class="tarjeta-item bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700/80 rounded-2xl p-5 shadow-xs transition hover:border-indigo-400 dark:hover:border-indigo-500" data-respondida="false">
                                    <div class="flex items-start justify-between gap-3 mb-3">
                                        <div class="flex items-center gap-2">
                                            <span class="w-6 h-6 rounded-lg bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 text-xs font-bold flex items-center justify-center shrink-0">#<?= $num ?></span>
                                            <div>
                                                <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-200"><?= htmlspecialchars($it['txt']) ?></h4>
                                                <span class="text-[10px] text-slate-400 dark:text-slate-500"><?= $it['subescala'] ?></span>
                                            </div>
                                        </div>
                                        <span class="badge-estado text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-500 dark:bg-slate-750 dark:text-slate-400 shrink-0">Pendiente</span>
                                    </div>
                                    <input type="hidden" name="<?= $it['nombre'] ?>" class="input-likert" value="2" required>
                                    <div class="opciones-likert grid grid-cols-2 sm:grid-cols-4 gap-2">
                                        <button type="button" class="btn-likert" data-valor="1" data-color="emerald">
                                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Nunca
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="2" data-color="amber">
                                            <span class="w-2 h-2 rounded-full bg-amber-500"></span> Pocas veces
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="3" data-color="orange">
                                            <span class="w-2 h-2 rounded-full bg-orange-500"></span> Frecuente
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="4" data-color="rose">
                                            <span class="w-2 h-2 rounded-full bg-rose-500"></span> Siempre
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- SECCIÓN 3: Ítems 13 al 16 -->
                        <div class="seccion-preguntas space-y-4 hidden" data-step="3">
                            <?php
                            $itemsSeccion4 = [
                                13 => ['nombre' => 'pregunta13', 'txt' => 'Me siento intranquilo(a) o con dificultad para relajarme', 'subescala' => 'Ansiedad'],
                                14 => ['nombre' => 'pregunta14', 'txt' => 'Me siento enfadado(a) o con resentimiento', 'subescala' => 'Hostilidad'],
                                15 => ['nombre' => 'pregunta15', 'txt' => 'Me siento contento(a) y con paz mental', 'subescala' => 'Bienestar'],
                                16 => ['nombre' => 'pregunta16', 'txt' => 'Me siento triste o afligido(a)', 'subescala' => 'Depresión']
                            ];
                            foreach ($itemsSeccion4 as $num => $it):
                            ?>
                                <div class="tarjeta-item bg-white dark:bg-slate-800 border border-slate-200/80 dark:border-slate-700/80 rounded-2xl p-5 shadow-xs transition hover:border-indigo-400 dark:hover:border-indigo-500" data-respondida="false">
                                    <div class="flex items-start justify-between gap-3 mb-3">
                                        <div class="flex items-center gap-2">
                                            <span class="w-6 h-6 rounded-lg bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 text-xs font-bold flex items-center justify-center shrink-0">#<?= $num ?></span>
                                            <div>
                                                <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-200"><?= htmlspecialchars($it['txt']) ?></h4>
                                                <span class="text-[10px] text-slate-400 dark:text-slate-500"><?= $it['subescala'] ?></span>
                                            </div>
                                        </div>
                                        <span class="badge-estado text-[10px] font-bold px-2 py-0.5 rounded-full bg-slate-100 text-slate-500 dark:bg-slate-750 dark:text-slate-400 shrink-0">Pendiente</span>
                                    </div>
                                    <input type="hidden" name="<?= $it['nombre'] ?>" class="input-likert" value="2" required>
                                    <div class="opciones-likert grid grid-cols-2 sm:grid-cols-4 gap-2">
                                        <button type="button" class="btn-likert" data-valor="1" data-color="emerald">
                                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Nunca
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="2" data-color="amber">
                                            <span class="w-2 h-2 rounded-full bg-amber-500"></span> Pocas veces
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="3" data-color="orange">
                                            <span class="w-2 h-2 rounded-full bg-orange-500"></span> Frecuente
                                        </button>
                                        <button type="button" class="btn-likert" data-valor="4" data-color="rose">
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
                        <span id="seccionProgresoActual" class="font-bold text-indigo-600 dark:text-indigo-400">0 de 4</span> respondidas en esta sección
                    </div>

                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <button type="button" id="btnPasoSiguiente" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl font-semibold text-sm text-white bg-indigo-600 hover:bg-indigo-700 transition shadow-xs">
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
    background-color: #4f46e5;
    color: #ffffff;
    border-color: #4f46e5;
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
    const totalSecciones = 4;
    let seccionActual = 0;

    const metadataSecciones = [
        {
            titulo: "A continuación encontrarás frases que describen sentimientos y estados de ánimo:",
            ilustracion: "/public/build/img/preguntaspsicología1.png",
            seccionNombre: "Sección 1: Estados de Ánimo Iniciales (1 al 4)"
        },
        {
            titulo: "Continúa evaluando cómo te has sentido en estos últimos días:",
            ilustracion: "/public/build/img/preguntaspsicología2.png",
            seccionNombre: "Sección 2: Tensión y Optimismo (5 al 8)"
        },
        {
            titulo: "Selecciona la frecuencia con la que has experimentado estas sensaciones:",
            ilustracion: "/public/build/img/preguntaspsicología3.png",
            seccionNombre: "Sección 3: Ansiedad y Vitalidad (9 al 12)"
        },
        {
            titulo: "Últimas 4 preguntas para completar tu evaluación emocional:",
            ilustracion: "/public/build/img/preguntaspsicología4.png",
            seccionNombre: "Sección 4: Tranquilidad y Bienestar (13 al 16)"
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
        if (progressBarFill) progressBarFill.style.width = Math.max(porcentaje, 25) + "%";
        if (progressPercentBadge) progressPercentBadge.textContent = porcentaje + "%";
        if (contadorRespondidas) contadorRespondidas.textContent = `${totalRespondidas} de ${todosLosItems.length} respondidas`;

        const seccionActivaEl = document.querySelector(`.seccion-preguntas[data-step="${seccionActual}"]`);
        if (seccionActivaEl) {
            const itemsEnSeccion = seccionActivaEl.querySelectorAll(".tarjeta-item");
            let respondidasEnSeccion = 0;
            itemsEnSeccion.forEach(item => {
                if (item.getAttribute("data-respondida") === "true") respondidasEnSeccion++;
            });
            if (seccionProgresoActual) seccionProgresoActual.textContent = `${respondidasEnSeccion} de ${itemsEnSeccion.length}`;

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

        const meta = metadataSecciones[seccionActual];
        if (meta) {
            if (preguntaGuiaTexto) preguntaGuiaTexto.textContent = meta.titulo;
            if (seccionIlustracion) seccionIlustracion.src = meta.ilustracion;
            if (labelSeccionActiva) labelSeccionActiva.textContent = meta.seccionNombre;
            if (seccionBadgeIndex) seccionBadgeIndex.textContent = `Sección ${seccionActual + 1} de ${totalSecciones}`;
            if (progressStepText) progressStepText.textContent = `Sección ${seccionActual + 1} de ${totalSecciones}`;
        }

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

    if (btnAnterior) {
        btnAnterior.addEventListener("click", () => {
            if (seccionActual > 0) mostrarSeccion(seccionActual - 1);
        });
    }

    if (btnSiguiente) {
        btnSiguiente.addEventListener("click", () => {
            const seccionActivaEl = document.querySelector(`.seccion-preguntas[data-step="${seccionActual}"]`);
            const pendientes = seccionActivaEl ? seccionActivaEl.querySelectorAll('.tarjeta-item[data-respondida="false"]') : [];
            
            if (pendientes.length > 0) {
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

    stepPills.forEach(pill => {
        pill.addEventListener("click", () => {
            const paso = parseInt(pill.getAttribute("data-step"), 10);
            mostrarSeccion(paso);
        });
    });

    const form = document.getElementById("formEncuestaPsicologia");
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

    mostrarSeccion(0);
});
</script>