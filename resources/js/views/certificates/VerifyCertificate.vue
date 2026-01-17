<template>
    <div class="verify-wrap">
        <!-- FORM CARD -->
        <div class="bg-white rounded-2xl p-6 md:p-8 border border-gray-200 shadow-sm">
            <h3 class="text-xl font-bold text-gray-900 mb-2">Validación</h3>
            <p class="text-gray-600 mb-6 text-sm">
                Ingresa tu DNI y consulta el certificado en nuestra base de datos.
            </p>

            <div class="space-y-4">
                <div>
                    <label for="dni" class="block text-sm font-semibold text-gray-900 mb-2">N° DNI</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                            </svg>
                        </div>
                        <input
                            id="dni"
                            v-model.trim="dni"
                            placeholder="Ej: 73617765"
                            @keyup.enter="verify"
                            :disabled="loading"
                            class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-[#0c5660] focus:ring-4 focus:ring-[#0c5660]/10 outline-none transition-all duration-300 text-gray-900 disabled:bg-gray-50 disabled:cursor-not-allowed"
                        />
                    </div>
                </div>

                <button
                    type="button"
                    @click="verify"
                    :disabled="loading"
                    class="w-full px-6 py-3 bg-gradient-to-r from-[#0c5660] to-[#0b3f45] text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-teal-500/30 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2"
                >
                    <svg v-if="loading" class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    {{ loading ? "Verificando..." : "Verificar" }}
                </button>
            </div>
        </div>

        <!-- RESULT PANEL -->
        <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl p-6 md:p-8 border border-gray-200 shadow-sm min-h-[280px]">
            <!-- IDLE STATE -->
            <div v-if="status === 'idle'" class="flex flex-col items-center justify-center h-full text-center py-8">
                <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="font-bold text-gray-900 mb-2">Resultado: —</div>
                <div class="text-sm text-gray-500">
                    Ingresa tu DNI y presiona <span class="font-semibold">Verificar</span>.
                </div>
            </div>

            <!-- SUCCESS STATE -->
            <div v-else-if="status === 'ok'" class="space-y-6">
                <div class="flex items-center gap-3 p-4 bg-green-50 border border-green-200 rounded-xl">
                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-bold text-green-900">Certificado válido</div>
                        <div class="text-sm text-green-700">Información verificada correctamente</div>
                    </div>
                </div>

                <div class="space-y-3">
                    <div class="flex items-start gap-2">
                        <span class="text-sm font-semibold text-gray-500 min-w-[80px]">Nombre:</span>
                        <span class="text-sm font-bold text-gray-900">{{ result.name || "—" }}</span>
                    </div>
                    <div class="flex items-start gap-2">
                        <span class="text-sm font-semibold text-gray-500 min-w-[80px]">Detalle:</span>
                        <span class="text-sm font-bold text-gray-900">{{ result.description || "—" }}</span>
                    </div>
                    <div class="flex items-start gap-2">
                        <span class="text-sm font-semibold text-gray-500 min-w-[80px]">Fecha:</span>
                        <span class="text-sm font-bold text-gray-900">{{ result.date || "—" }}</span>
                    </div>
                    <div class="flex items-start gap-2">
                        <span class="text-sm font-semibold text-gray-500 min-w-[80px]">DNI:</span>
                        <span class="text-sm font-bold text-gray-900">{{ dni }}</span>
                    </div>
                </div>

                <!-- Preview -->
                <div v-if="result.pdf_url" class="space-y-3">
                    <div class="text-sm font-semibold text-gray-500">Vista previa:</div>
                    <a :href="result.pdf_url" target="_blank" rel="noopener" class="block">
                        <img
                            v-if="isImage"
                            :src="result.pdf_url"
                            alt="Certificado"
                            class="w-full max-w-md rounded-xl border-2 border-gray-200 shadow-lg hover:shadow-xl transition-shadow"
                        />
                        <div v-else class="p-6 bg-gray-50 border-2 border-gray-200 rounded-xl hover:border-gray-300 transition-colors">
                            <div class="flex items-center gap-3">
                                <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <div class="font-bold text-gray-900">Archivo PDF</div>
                                    <div class="text-sm text-gray-500">Click para abrir en nueva pestaña</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Actions -->
                <div class="flex flex-wrap gap-3 pt-4 border-t border-gray-200">
                    <a
                        v-if="result.pdf_url"
                        :href="result.pdf_url"
                        target="_blank"
                        rel="noopener"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-[#0c5660] to-[#0b3f45] text-white rounded-lg font-semibold text-sm hover:shadow-lg transition-all"
                    >
                        Abrir en nueva pestaña
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </a>
                    <button
                        type="button"
                        @click="reset"
                        class="inline-flex items-center gap-2 px-5 py-2.5 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold text-sm hover:bg-gray-50 transition-all"
                    >
                        Nueva consulta
                    </button>
                </div>

                <!-- Warning -->
                <div v-if="warning" class="p-4 bg-yellow-50 border border-yellow-200 rounded-xl">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-sm font-medium text-yellow-800">{{ warning }}</p>
                    </div>
                </div>
            </div>

            <!-- ERROR STATE -->
            <div v-else-if="status === 'bad'" class="space-y-6">
                <div class="flex items-center gap-3 p-4 bg-red-50 border border-red-200 rounded-xl">
                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-bold text-red-900">No se encontró el certificado</div>
                        <div class="text-sm text-red-700">{{ error || "Verifica el DNI o contáctanos para soporte." }}</div>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a
                        href="#contactos"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-[#f1841a] to-[#ff9a3d] text-white rounded-lg font-semibold text-sm hover:shadow-lg transition-all"
                    >
                        Contactar soporte
                    </a>
                    <button
                        type="button"
                        @click="reset"
                        class="inline-flex items-center gap-2 px-5 py-2.5 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold text-sm hover:bg-gray-50 transition-all"
                    >
                        Intentar otra vez
                    </button>
                </div>
            </div>

            <!-- Extra Error -->
            <div v-if="status !== 'bad' && error" class="p-4 bg-red-50 border border-red-200 rounded-xl">
                <p class="text-sm font-medium text-red-800">{{ error }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "VerifyCertificate",
    data() {
        return {
            dni: "",
            loading: false,
            status: "idle", // idle | ok | bad
            result: { name: "", description: "", date: "", pdf_url: "" },
            error: null,
            warning: null,
        };
    },
    computed: {
        fileExt() {
            const url = (this.result.pdf_url || "").toLowerCase();
            const clean = url.split("?")[0].split("#")[0];
            const parts = clean.split(".");
            return parts.length > 1 ? parts[parts.length - 1] : "";
        },
        isImage() {
            return ["png", "jpg", "jpeg", "webp", "gif"].includes(this.fileExt);
        },
    },
    methods: {
        async verify() {
            this.error = null;
            this.warning = null;

            if (!this.dni) {
                this.error = "Ingresa un DNI válido.";
                return;
            }

            this.loading = true;
            this.status = "idle";

            try {
                const res = await this.$http.get("/certificates/verify", {
                    params: { dni: this.dni },
                    headers: {
                        Accept: "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                    },
                });

                let payload = res?.data;

                if (typeof payload === "string") {
                    try {
                        payload = JSON.parse(payload);
                    } catch (e) {
                        this.status = "bad";
                        this.error =
                            "El endpoint respondió HTML/texto, no JSON. Revisa /certificates/verify.";
                        return;
                    }
                }

                const ok = payload?.ok === true;
                const raw = payload?.data || null;

                if (!ok || !raw) {
                    this.status = "bad";
                    this.error =
                        payload?.message || "No se encontró el certificado";
                    return;
                }

                this.result = {
                    name: raw.name || "—",
                    description: raw.description || "—",
                    date: raw.date || "—",
                    pdf_url: raw.pdf_url || raw.file_url || null,
                };

                this.status = "ok";

                if (!this.result.pdf_url) {
                    this.warning =
                        "El certificado existe, pero no tiene archivo asociado.";
                }

                console.log("[verify] payload:", payload);
                console.log("[verify] normalized result:", this.result);
            } catch (err) {
                this.status = "bad";
                const backendMsg =
                    err?.response?.data?.message ||
                    err?.response?.data?.error ||
                    null;

                this.error = backendMsg || "Error consultando el servidor.";
                console.error("[verify] error:", err);
            } finally {
                this.loading = false;
            }
        },
        reset() {
            this.dni = "";
            this.status = "idle";
            this.result = { name: "", description: "", date: "", pdf_url: "" };
            this.error = null;
            this.warning = null;
        },
    },
};
</script>

<style scoped>
.verify-wrap {
    display: grid;
    grid-template-columns: 420px 1fr;
    gap: 16px;
    align-items: start;
}

@media (max-width: 980px) {
    .verify-wrap {
        grid-template-columns: 1fr;
    }
}

.result-panel {
    border: 1px dashed rgba(0, 0, 0, 0.12);
    border-radius: 16px;
    padding: 18px;
    min-height: 210px;
    background: rgba(255, 255, 255, 0.75);
    backdrop-filter: blur(8px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.06);
}

.result-empty {
    color: var(--muted);
    padding: 4px;
}

.result-ok,
.result-bad {
    display: block;
}

.result-data {
    margin-top: 12px;
    display: grid;
    gap: 6px;
    color: #0f172a;
}
.result-data span {
    color: var(--muted);
    font-weight: 800;
    margin-right: 6px;
}

.result-actions {
    margin-top: 14px;
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.error-box {
    margin-top: 12px;
    color: #b42318;
    font-weight: 800;
}

.warn-box {
    margin-top: 12px;
    padding: 10px 12px;
    border-radius: 12px;
    background: rgba(245, 158, 11, 0.12);
    border: 1px solid rgba(245, 158, 11, 0.22);
    font-weight: 800;
    color: #92400e;
}

.pdf-preview {
    margin-top: 8px;
    padding: 14px;
    border-radius: 12px;
    border: 1px solid rgba(0, 0, 0, 0.08);
    background: rgba(15, 23, 42, 0.03);
}
</style>
