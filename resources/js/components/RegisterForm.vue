<template>
    <div class="space-y-6" v-cloak>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label for="regDni" class="block text-sm font-semibold text-gray-900 mb-2">N° DNI</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                        </svg>
                    </div>
                    <input
                        id="regDni"
                        placeholder="N° DNI"
                        v-model="form.number"
                        @input="handleDniInput"
                        class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-[#0c5660] focus:ring-4 focus:ring-[#0c5660]/10 outline-none transition-all duration-300 text-gray-900"
                    />
                </div>
            </div>

            <div>
                <label for="regFullName" class="block text-sm font-semibold text-gray-900 mb-2">Nombres y Apellidos</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <input
                        id="regFullName"
                        placeholder="Nombres y Apellidos"
                        v-model="form.full_name"
                        :readonly="true"
                        class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl bg-gray-50 text-gray-700 cursor-not-allowed"
                    />
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label for="regEmail" class="block text-sm font-semibold text-gray-900 mb-2">Correo Electrónico</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <input
                        id="regEmail"
                        type="email"
                        placeholder="correo@dominio.com"
                        v-model="form.email"
                        class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-[#0c5660] focus:ring-4 focus:ring-[#0c5660]/10 outline-none transition-all duration-300 text-gray-900"
                    />
                </div>
            </div>

            <div>
                <label for="regPhone" class="block text-sm font-semibold text-gray-900 mb-2">N° WhatsApp</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 32 32">
                            <path d="M19.1 17.5c-.2-.1-1.4-.7-1.6-.8-.2-.1-.4-.1-.6.1-.2.2-.7.8-.9 1-.2.2-.3.2-.5.1-.2-.1-1.1-.4-2.1-1.3-.8-.7-1.3-1.6-1.5-1.8-.1-.2 0-.4.1-.5.1-.1.2-.3.3-.4.1-.1.1-.3.2-.4.1-.1 0-.3 0-.5-.1-.2-.6-1.4-.8-1.9-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.7.3-.2.2-.9.8-.9 2s.9 2.3 1 2.5c.1.2 1.8 2.7 4.3 3.8.6.3 1.1.4 1.4.5.6.2 1.2.2 1.7.1.5-.1 1.4-.6 1.6-1.2.2-.6.2-1.1.1-1.2-.1-.1-.2-.2-.4-.3z"/>
                            <path d="M26.6 5.4C24 2.8 20.6 1.4 17 1.4 9.5 1.4 3.4 7.5 3.4 15c0 2.4.6 4.6 1.7 6.6L3 30l8.6-2.2c1.9 1 3.9 1.6 6 1.6h.1c7.5 0 13.6-6.1 13.6-13.6 0-3.6-1.4-7-4-9.6zM17.6 26.7h-.1c-1.9 0-3.7-.5-5.3-1.4l-.4-.2-5.1 1.3 1.4-5-.3-.5c-1-1.6-1.5-3.4-1.5-5.2C6.3 9.1 11 4.4 17 4.4c2.8 0 5.4 1.1 7.4 3.1 2 2 3.1 4.6 3.1 7.4 0 5.8-4.7 11.8-10.9 11.8z"/>
                        </svg>
                    </div>
                    <input
                        id="regPhone"
                        placeholder="999 999 999"
                        v-model="form.phone"
                        class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-[#0c5660] focus:ring-4 focus:ring-[#0c5660]/10 outline-none transition-all duration-300 text-gray-900"
                    />
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button
                type="button"
                @click="submit"
                :disabled="loadingSubmit"
                class="px-8 py-3 bg-gradient-to-r from-[#f1841a] to-[#ff9a3d] text-white rounded-xl font-semibold hover:shadow-lg hover:shadow-orange-500/30 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2"
            >
                <svg v-if="loadingSubmit" class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                {{ loadingSubmit ? "Enviando..." : "Crear cuenta" }}
            </button>
        </div>

        <div v-if="message" class="p-4 bg-blue-50 border border-blue-200 rounded-xl">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <p class="text-sm font-medium text-blue-800">{{ message }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                number: "",
                full_name: "",
                email: "",
                phone: "",
                address: "",
                program: "",
            },
            message: "",
            loadingSearch: false,
            loadingSubmit: false,
            searchTimeout: null,
            courses: [],
        };
    },

    async mounted() {
        try {
            const response = await this.$http.get(`/api/public/users/tables`);
            if (response.data && response.data.success) {
                this.courses = response.data.data || [];
                console.log("this.courses", this.courses);
            }
        } catch (e) {
            // no tumbar el render
            console.warn("No se pudo cargar cursos", e);
        }
    },

    methods: {
        handleDniInput() {
            const value = String(this.form.number || "").trim();
            this.message = "";

            if (this.searchTimeout) clearTimeout(this.searchTimeout);
            if (value.length < 8) return;

            if (value.length === 8) this.fetchDni(value);
        },

        async fetchDni(number) {
            this.loadingSearch = true;
            try {
                const response = await this.$http.get(
                    `/api/public/users/search/${number}`
                );

                if (response.data && response.data.status === "ok") {
                    const data = response.data.data || {};
                    const nombres = data.nombres || "";
                    const apPat = data.apellido_paterno || "";
                    const apMat = data.apellido_materno || "";
                    const full = `${apPat} ${apMat} ${nombres}`
                        .replace(/\s+/g, " ")
                        .trim();

                    this.form.full_name = full || nombres || "";
                    this.form.address = data.direccion || "";
                } else {
                    this.form.full_name = "";
                    this.form.address = "";
                    this.message = "No se encontraron datos para el DNI.";
                }
            } catch (error) {
                this.form.full_name = "";
                this.form.address = "";
                this.message = "No se pudo consultar el DNI.";
            } finally {
                this.loadingSearch = false;
            }
        },

        async submit() {
            if (!this.form.number) {
                this.message = "Ingresa el DNI.";
                return;
            }

            this.loadingSubmit = true;
            this.message = "";

            const csrfToken =
                typeof document !== "undefined"
                    ? document
                          .querySelector('meta[name="csrf-token"]')
                          ?.getAttribute("content")
                    : null;

            const payload = {
                number: this.form.number,
                first_name: this.form.full_name,
                last_name: this.form.full_name,
                address: this.form.address,
                phone: this.form.phone,
                email: this.form.email,
                program: this.form.program,
            };

            try {
                const response = await this.$http.post(
                    "/api/public/users/save",
                    payload
                );

                if (response.data && response.data.success) {
                    this.message = response.data.message || "Registro enviado.";
                    this.form = {
                        number: "",
                        full_name: "",
                        email: "",
                        phone: "",
                        address: "",
                        program: "",
                    };
                } else {
                    this.message = "No se pudo guardar el registro.";
                }
            } catch (error) {
                this.message = "Error al guardar el registro.";
            } finally {
                this.loadingSubmit = false;
            }
        },
    },
};
</script>
