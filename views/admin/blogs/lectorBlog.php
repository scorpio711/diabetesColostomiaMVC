<script src="/tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
<link rel="stylesheet" href="/public/build/css/blogs.css">

<?php
$imgUsuario = (!empty($usuario) && !empty($usuario->imagen))
    ? "/public/imagenesUsuarios/" . htmlspecialchars($usuario->imagen)
    : "https://ui-avatars.com/api/?name=" . urlencode($blog->nombre ?: 'Profesional') . "&background=0D9488&color=fff";
$nombreAutor = !empty($usuario) ? htmlspecialchars($usuario->nombre) : (!empty($blog->nombre) ? htmlspecialchars($blog->nombre) : "Profesional");
$profesion = !empty($profesional) ? htmlspecialchars($profesional->profesion) : (!empty($blog->cargo) ? htmlspecialchars(ucfirst($blog->cargo)) : "Especialista en Salud");
?>

<main class="pt-24 pb-16 lg:pt-24 lg:pb-24 bg-white dark:bg-gray-900 antialiased min-h-screen">
    
    <?php if ($esDuenio || $esAdmin): ?>
    <!-- Modal para Publicar / Configurar Investigación -->
    <div id="createProductModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-slate-900/50 backdrop-blur-xs">

        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative p-6 bg-white rounded-2xl shadow-xl dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
                <!-- Modal header -->
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Publicar Artículo en Catálogo</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Completa los datos de la ficha clínica para que los pacientes puedan encontrarlo en el sitio web.</p>
                    </div>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-target="createProductModal" data-modal-toggle="createProductModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Cerrar modal</span>
                    </button>
                </div>

                <?php if (!empty($errores)): ?>
                    <div class="space-y-2 mb-4">
                        <?php foreach ($errores as $error): ?>
                            <div class="flex items-center p-3 text-sm text-red-800 rounded-xl bg-red-50 dark:bg-gray-800 dark:text-red-400 border border-red-200 dark:border-red-900" role="alert">
                                <svg class="flex-shrink-0 inline w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                <span><?= htmlspecialchars($error) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Modal body -->
                <form method="POST" enctype="multipart/form-data" class="space-y-4">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label for="titulo" class="block mb-1 text-sm font-semibold text-gray-900 dark:text-white">Título de la Publicación</label>
                            <input value="<?php echo s($blog->titulo); ?>" type="text" name="titulo" id="titulo"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="Escribe el título" required>
                        </div>
                        <div>
                            <label for="autor" class="block mb-1 text-sm font-semibold text-gray-900 dark:text-white">Autor(es)</label>
                            <input value="<?php echo s($nombreAutor); ?>" type="text" name="autor" id="autor"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="Nombre del autor" required>
                        </div>
                        <div>
                            <label for="fecha" class="block mb-1 text-sm font-semibold text-gray-900 dark:text-white">Fecha de Publicación</label>
                            <input value="<?php echo date('Y-m-d', strtotime(s($fecha))); ?>" type="date"
                                name="fecha_publicacion" id="fecha"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="resumen" class="block mb-1 text-sm font-semibold text-gray-900 dark:text-white">Resumen / Abstract (50 a 400 caracteres)</label>
                            <textarea id="resumen" name="resumen" rows="3" minlength="50" maxlength="400"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-xl border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="Sintetiza de qué trata el artículo y su impacto en la salud de los pacientes..." required><?php echo s($investigacionC->resumen ?? ''); ?></textarea>
                            <p class="text-xs text-gray-500 mt-1">Este resumen aparecerá en la tarjeta del listado público de artículos e investigaciones.</p>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block mb-1 text-sm font-semibold text-gray-900 dark:text-white">Imagen de Portada</label>
                            <label for="imagen"
                                class="flex flex-col items-center justify-center w-full h-36 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 transition-colors">
                                <div class="flex flex-col items-center justify-center pt-3 pb-3">
                                    <svg aria-hidden="true" class="w-8 h-8 mb-2 text-teal-600 dark:text-teal-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-sm text-gray-600 dark:text-gray-300 font-medium">Haz clic para subir una foto de portada</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">JPG, PNG o WEBP (recomendado 800x600px)</p>
                                </div>
                                <input id="imagen" name="imagen" type="file" class="hidden" accept="image/*" />
                            </label>
                            <?php if (!empty($investigacionC->imagen)): ?>
                                <p class="text-xs text-emerald-600 dark:text-emerald-400 font-medium mt-1">✓ Ya cuenta con portada asignada. Si no seleccionas otra, se mantendrá la actual.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="pt-2 flex justify-end gap-3">
                        <button type="button" data-modal-target="createProductModal" data-modal-toggle="createProductModal"
                            class="py-2.5 px-5 text-sm font-medium text-gray-700 bg-white rounded-xl border border-gray-300 hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600">Cancelar</button>
                        <button type="submit" name="crear"
                            class="text-white inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 focus:ring-4 focus:outline-none focus:ring-teal-300 font-semibold rounded-xl text-sm px-6 py-2.5 transition-all shadow-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Confirmar y Publicar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="px-4 mx-auto max-w-4xl">

        <!-- Notificaciones de éxito -->
        <?php if (intval($resultado) === 1): ?>
            <div class="flex items-center p-4 mb-6 text-emerald-800 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800 shadow-xs" role="alert">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <div class="text-sm font-semibold">El artículo ha sido publicado exitosamente y ya es visible en el catálogo de investigaciones.</div>
            </div>
        <?php elseif (intval($resultado) === 3): ?>
            <div class="flex items-center p-4 mb-6 text-amber-800 rounded-2xl bg-amber-50 dark:bg-amber-950/40 dark:text-amber-300 border border-amber-200 dark:border-amber-800 shadow-xs" role="alert">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <div class="text-sm font-semibold">El artículo se ha ocultado del catálogo público y ahora se encuentra en estado Borrador (Privado).</div>
            </div>
        <?php endif; ?>

        <!-- Barra de Gestión del Autor -->
        <?php if ($esDuenio || $esAdmin): ?>
            <div class="mb-8 p-4 bg-slate-50 dark:bg-slate-800/80 rounded-2xl border border-slate-200 dark:border-slate-700 flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold <?= intval($blog->publico) === 1 ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800' : 'bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300 border border-amber-200 dark:border-amber-800' ?>">
                        <span class="w-2 h-2 rounded-full <?= intval($blog->publico) === 1 ? 'bg-emerald-500' : 'bg-amber-500' ?>"></span>
                        <?= intval($blog->publico) === 1 ? 'Público en Investigaciones' : 'Borrador Privado' ?>
                    </span>
                    <span class="text-xs text-slate-500 dark:text-slate-400">Modo Edición Profesional</span>
                </div>

                <div class="flex flex-wrap items-center gap-2.5">
                    <a href="/public/admin/blog"
                        class="inline-flex items-center gap-1.5 py-2 px-4 text-xs font-medium text-slate-700 bg-white rounded-xl border border-slate-300 hover:bg-slate-100 dark:bg-slate-700 dark:text-slate-200 dark:border-slate-600 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Volver al Panel
                    </a>

                    <button data-modal-target="static-modal" data-modal-toggle="static-modal"
                        class="inline-flex items-center gap-1.5 text-white bg-teal-600 hover:bg-teal-700 font-semibold rounded-xl text-xs px-4 py-2 transition-all shadow-xs"
                        type="button">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Editar Contenido (TinyMCE)
                    </button>

                    <?php if (intval($blog->publico) == 0): ?>
                        <button type="button" data-modal-target="createProductModal" data-modal-toggle="createProductModal"
                            class="inline-flex items-center gap-1.5 text-white bg-emerald-600 hover:bg-emerald-700 font-semibold rounded-xl text-xs px-4 py-2 transition-all shadow-xs">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                            Publicar Artículo
                        </button>
                    <?php else: ?>
                        <form method="POST" class="inline m-0">
                            <button type="submit" name="ocultar"
                                class="inline-flex items-center gap-1.5 text-amber-700 bg-amber-100 hover:bg-amber-200 dark:bg-amber-950 dark:text-amber-300 border border-amber-300 dark:border-amber-800 font-semibold rounded-xl text-xs px-4 py-2 transition-all">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                </svg>
                                Ocultar / Pasar a Borrador
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Modal Editor TinyMCE -->
            <div id="static-modal" data-modal-backdrop="static" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-slate-900/60 backdrop-blur-xs">
                <div class="relative p-4 w-full max-w-5xl max-h-full">
                    <div class="relative bg-white rounded-2xl shadow-2xl dark:bg-gray-800 border border-gray-200 dark:border-gray-700 overflow-hidden">
                        
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 dark:border-gray-700">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Editor de Contenido Clínico</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Edita el artículo con formato enriquecido, imágenes, listas y tablas.</p>
                            </div>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="static-modal">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Cerrar</span>
                            </button>
                        </div>

                        <!-- Modal body -->
                        <div class="p-4 md:p-6 space-y-4">
                            <form id="formulario">
                                <textarea id="editor"><?php echo htmlspecialchars($contenido_html); ?></textarea>
                                
                                <div class="flex items-center justify-between pt-4 mt-4 border-t border-gray-200 dark:border-gray-700">
                                    <span class="text-xs text-gray-400 dark:text-gray-500">Los cambios se guardan al hacer clic en Guardar Cambios.</span>
                                    <div class="flex items-center gap-3">
                                        <button data-modal-hide="static-modal" type="button"
                                            class="py-2.5 px-5 text-sm font-medium text-gray-700 bg-white rounded-xl border border-gray-300 hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600">
                                            Cancelar
                                        </button>
                                        <button id="btnGuardarBlog" type="submit"
                                            class="text-white bg-teal-600 hover:bg-teal-700 font-semibold rounded-xl text-sm px-6 py-2.5 transition-all shadow-sm">
                                            Guardar Cambios
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Encabezado del Artículo -->
        <article class="prose lg:prose-xl dark:prose-invert max-w-none">
            <header class="mb-8 not-prose">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-teal-100 text-teal-800 dark:bg-teal-950/60 dark:text-teal-300 mb-4 border border-teal-200 dark:border-teal-800">
                    <span>🩺</span>
                    <span>Artículo Especializado</span>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight mb-6">
                    <?= htmlspecialchars($blog->titulo) ?>
                </h1>

                <address class="flex items-center not-italic pt-4 border-t border-slate-200 dark:border-slate-800">
                    <img class="mr-4 w-14 h-14 rounded-full object-cover border-2 border-teal-500/20 shadow-xs"
                        src="<?= $imgUsuario ?>" alt="<?= $nombreAutor ?>">
                    <div>
                        <div class="text-base font-bold text-slate-900 dark:text-white"><?= $nombreAutor ?></div>
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium"><?= $profesion ?></p>
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5"><time pubdate datetime="<?= $blog->fecha_creacion ?>"><?= $fecha ?></time></p>
                    </div>
                </address>
            </header>

            <!-- Contenido del Artículo -->
            <div class="text-slate-800 dark:text-slate-200 leading-relaxed font-normal text-base sm:text-lg space-y-4">
                <?= $contenido_html ?>
            </div>
        </article>

        <!-- Pie de Artículo -->
        <div class="mt-12 pt-8 border-t border-slate-200 dark:border-slate-800 flex items-center justify-between">
            <a href="/public/investigaciones" class="inline-flex items-center gap-2 text-sm font-semibold text-teal-600 dark:text-teal-400 hover:text-teal-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Explorar Más Investigaciones
            </a>
            <span class="text-xs text-slate-400">Plataforma Médica Colostomía y Diabetes</span>
        </div>

    </div>
</main>

<script src="/public/build/js/editor.js"></script>