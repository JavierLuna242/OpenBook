<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-8">
                
                <!-- Sidebar -->


                <!-- Main Content -->
                <div class="flex-1 space-y-8">
                    
                    <!-- Header -->
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white/40 backdrop-blur-md p-6 rounded-[2rem] border border-outline-variant/15 shadow-sm">
                        <div>
                            <h1 class="text-3xl font-extrabold text-on-surface mb-2">Material <span class="dashboard-gradient-text">Académico</span></h1>
                            <p class="text-sm font-semibold text-on-surface-variant">Sube guías, ejercicios o resúmenes para que los estudiantes puedan descargarlos y aprender.</p>
                        </div>
                    </div>

                    @if (session('success'))
                        <div class="p-4 bg-success/15 text-success rounded-2xl text-sm font-bold flex items-center shadow-sm">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="p-4 bg-red-50 text-red-600 rounded-2xl text-sm font-bold shadow-sm">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Upload Form -->
                    <x-card class="!p-8 border border-outline-variant/10">
                        <h2 class="text-xl font-bold text-on-surface mb-6 flex items-center gap-2">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            Subir Nuevo Material
                        </h2>
                        
                        <form action="{{ route('dashboard.tutor.materials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-on-surface mb-2">Título del Recurso *</label>
                                    <input type="text" name="title" required placeholder="Ej: Guía de Cálculo Diferencial" class="w-full rounded-xl border-outline-variant/30 bg-surface-container/50 focus:bg-white focus:ring-primary focus:border-primary transition-colors text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-on-surface mb-2">Archivo (PDF, DOCX, ZIP, etc. Max 10MB) *</label>
                                    <input type="file" name="document" required class="w-full rounded-xl border border-outline-variant/30 bg-surface-container/50 focus:bg-white focus:ring-primary focus:border-primary transition-colors text-sm px-3 py-2 text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 cursor-pointer">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-bold text-on-surface mb-2">Descripción (Opcional)</label>
                                <textarea name="description" rows="3" placeholder="Explica brevemente de qué trata este material..." class="w-full rounded-xl border-outline-variant/30 bg-surface-container/50 focus:bg-white focus:ring-primary focus:border-primary transition-colors text-sm"></textarea>
                            </div>
                            
                            <div class="flex justify-end">
                                <button type="submit" class="px-6 py-3 bg-primary hover:bg-primary-dark text-white font-bold rounded-xl shadow-lg shadow-primary/30 transition-all flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    Publicar Material
                                </button>
                            </div>
                        </form>
                    </x-card>

                    <!-- My Materials List -->
                    <x-card class="!p-8 border border-outline-variant/10">
                        <h2 class="text-xl font-bold text-on-surface mb-6 flex items-center gap-2">
                            <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                            Mis Recursos Publicados
                        </h2>

                        @if ($materials->isEmpty())
                            <div class="text-center py-12 bg-surface-container/30 rounded-2xl border border-dashed border-outline-variant/30">
                                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm text-outline-variant">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <h3 class="text-lg font-bold text-on-surface mb-2">Aún no has subido materiales</h3>
                                <p class="text-on-surface-variant text-sm max-w-sm mx-auto">Tus materiales académicos aparecerán aquí. ¡Comparte tu conocimiento con la comunidad!</p>
                            </div>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($materials as $material)
                                    <div class="group border border-outline-variant/20 bg-white rounded-2xl p-5 hover:border-primary/30 hover:shadow-lg transition-all relative overflow-hidden flex flex-col h-full">
                                        <!-- Decorative accent -->
                                        <div class="absolute top-0 left-0 w-1 h-full bg-primary/20 group-hover:bg-primary transition-colors"></div>
                                        
                                        <div class="flex justify-between items-start mb-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-12 h-12 rounded-xl bg-surface-container-high flex items-center justify-center text-primary font-black uppercase shadow-inner text-xs border border-outline-variant/10">
                                                    {{ substr($material->file_type ?? 'DOC', 0, 4) }}
                                                </div>
                                                <div>
                                                    <h3 class="font-bold text-on-surface text-base line-clamp-1" title="{{ $material->title }}">{{ $material->title }}</h3>
                                                    <p class="text-xs text-on-surface-variant font-mono mt-0.5">{{ $material->file_size }} • {{ $material->created_at->format('d M, Y') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <p class="text-sm text-on-surface-variant mb-6 line-clamp-2 flex-grow">{{ $material->description ?: 'Sin descripción.' }}</p>
                                        
                                        <div class="flex items-center justify-between mt-auto pt-4 border-t border-outline-variant/10">
                                            <a href="{{ route('dashboard.materials.download', $material) }}" class="text-primary text-sm font-bold hover:underline flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                                Descargar
                                            </a>
                                            <form action="{{ route('dashboard.tutor.materials.destroy', $material) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este material?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 p-2 rounded-lg hover:bg-red-50 transition-colors" title="Eliminar material">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </x-card>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
