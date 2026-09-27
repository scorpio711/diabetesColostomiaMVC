<!-- Sección de Investigaciones y Artículos -->
<section class="py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6">
        <!-- Encabezado de la sección -->
        <div class="mx-auto max-w-2xl text-center mb-10">
            <span
                class="px-3.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                Recursos & Evidencia Científica
            </span>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mt-3 mb-3">
                Artículos e Investigaciones
            </h2>
            <p class="text-gray-600 dark:text-gray-400 text-base">
                Publicaciones científicas, protocolos y estudios especializados para respaldar el cuidado de tu salud con rigor médico.
            </p>
        </div>

        <?php if (!empty($investigaciones)): ?>
            <!-- Cuadrícula de tarjetas -->
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 items-stretch">
                <?php foreach ($investigaciones as $investigacion): ?>
                    <?php
                    $imgSrc = !empty($investigacion->imagen)
                        ? "/public/imagenesInvestigaciones/" . htmlspecialchars($investigacion->imagen)
                        : "/public/build/img/hands-1327811_1920.jpg";
                    $url = !empty($investigacion->url) ? htmlspecialchars($investigacion->url) : "#";
                    ?>
                    <!-- Tarjeta individual -->
                    <article
                        class="flex flex-col h-full bg-white dark:bg-gray-800 rounded-3xl border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm hover:shadow-xl hover:shadow-emerald-500/10 hover:-translate-y-1.5 transition-all duration-300 group">
                        
                        <!-- Contenedor de imagen -->
                        <div class="relative h-48 sm:h-52 w-full overflow-hidden bg-gray-100 dark:bg-gray-700">
                            <a href="<?php echo $url; ?>" target="_blank" rel="noopener noreferrer" class="block w-full h-full">
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    src="<?php echo $imgSrc; ?>"
                                    alt="<?php echo htmlspecialchars($investigacion->titulo); ?>"
                                    loading="lazy" />
                            </a>
                            <span
                                class="absolute top-3 left-3 px-2.5 py-1 rounded-full text-xs font-semibold bg-white dark:bg-gray-800 text-emerald-800 dark:text-emerald-300 border border-gray-200 dark:border-gray-700 shadow-sm flex items-center gap-1.5">
                                <span>🔬</span>
                                <span>Artículo Clínico</span>
                            </span>
                        </div>

                        <!-- Contenido de la tarjeta -->
                        <div class="p-6 flex flex-col justify-between flex-1">
                            <div>
                                <!-- Metadatos (Autor y Fecha) -->
                                <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 mb-3 gap-2">
                                    <?php if (!empty($investigacion->autor)): ?>
                                        <span class="inline-flex items-center gap-1 truncate font-medium" title="<?php echo htmlspecialchars($investigacion->autor); ?>">
                                            <svg class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            <span class="truncate"><?php echo htmlspecialchars($investigacion->autor); ?></span>
                                        </span>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($investigacion->fecha_publicacion)): ?>
                                        <span class="flex-shrink-0 text-gray-400 dark:text-gray-500 text-xs">
                                            <?php echo date('d/m/Y', strtotime($investigacion->fecha_publicacion)); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <!-- Título del artículo -->
                                <a href="<?php echo $url; ?>" target="_blank" rel="noopener noreferrer" class="block group/link">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover/link:text-emerald-600 dark:group-hover/link:text-emerald-400 transition-colors line-clamp-2 leading-snug mb-3">
                                        <?php echo htmlspecialchars($investigacion->titulo); ?>
                                    </h3>
                                </a>

                                <!-- Resumen / Extracto -->
                                <p class="text-gray-600 dark:text-gray-300 text-sm leading-relaxed mb-6 line-clamp-3">
                                    <?php 
                                    $resumenLimpio = strip_tags($investigacion->resumen ?? '');
                                    echo htmlspecialchars(mb_substr($resumenLimpio, 0, 115)); 
                                    echo mb_strlen($resumenLimpio) > 115 ? '...' : '';
                                    ?>
                                </p>
                            </div>

                            <!-- Botón de acción hacia el artículo -->
                            <a href="<?php echo $url; ?>"
                                target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center justify-center gap-2 w-full px-4 py-2.5 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl shadow-sm hover:shadow-md transition-all duration-200 group-hover:-translate-y-0.5 mt-auto">
                                <span>Leer investigación</span>
                                <svg class="w-4 h-4 rtl:rotate-180 transform group-hover:translate-x-1 transition-transform"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-3xl border border-gray-200 dark:border-gray-700 max-w-lg mx-auto p-8 shadow-sm">
                <span class="text-4xl block mb-3">📚</span>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Próximamente nuevas investigaciones</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Actualmente nuestro equipo médico está revisando nuevos artículos para compartirlos con la comunidad.</p>
            </div>
        <?php endif; ?>
    </div>
</section>