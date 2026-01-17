<template>
    <el-dialog
        :close-on-click-modal="false"
        :close-on-press-escape="false"
        :title="titleDialog"
        :visible="showDialog"
        width="50%"
        @open="create"
        @close="handleClose"
    >
        <div v-loading="loading">
            <el-form label-position="top">
                <div class="row">
                    <!-- Descripción -->
                    <div class="col-md-8">
                        <div class="row">
                             <div class="col-md-12">
                                <div class="form-group" :class="{ 'has-danger': errors.description }">
                                    <label class="control-label w-100">Usuario - Alumno</label>
                                     <el-select
                                        v-model="form.user_id"
                                        placeholder="Seleccionar un usuario"
                                        class="w-100"
                                        clearable
                                    >
                                        <el-option
                                            v-for="item in users"
                                            :key="item.id"
                                            :label="item.name"
                                            :value="item.id"
                                        />
                                    </el-select>
                                </div>        
                             </div>
                            <div class="col-md-12">
                                <div class="form-group" :class="{ 'has-danger': errors.description }">
                            <label class="control-label">Titulo</label>
                            <el-input
                                v-model="form.description"
                                type="textarea"
                                :rows="1"
                                resize="none"
                            />
                            <small class="text-danger" v-if="errors.description">
                                {{ errors.description[0] }}
                            </small>
                        </div>
                            </div>
                        </div>
                        
                    </div>

                    <!-- Archivo -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Archivo</label>
                            <el-upload
                                :action="`/${resource}/upload`"
                                :headers="headers"
                                :data="uploadData"
                                :on-success="onSuccess"
                                :on-error="onUploadError"
                                :show-file-list="false"
                                class="avatar-uploader"
                            >
                                <img
                                    v-if="showImagePreview"
                                    :src="form.file_url"
                                    alt="Vista previa del certificado"
                                    class="avatar"
                                />
                                <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                            </el-upload>

                            <p v-if="showFileLink" class="mt-2 text-success">
                                <a :href="form.file_url" target="_blank" rel="noopener">
                                    <i class="el-icon-document"></i>
                                    {{ form.file }}
                                </a>
                            </p>

                            <small class="text-danger" v-if="errors.file">
                                {{ errors.file[0] }}
                            </small>
                        </div>
                    </div>
                </div>
            </el-form>
        </div>

        <template v-slot:footer>
            <span class="dialog-footer">
                <el-button @click="handleClose">Cancelar</el-button>
                <el-button type="primary" :loading="loadingSubmit" @click="submit">
                    Guardar
                </el-button>
            </span>
        </template>
    </el-dialog>
</template>
<script>
export default {
    props: {
        showDialog: Boolean,
        recordId: [Number, String, null],
    },
    data() {
        return {
            resource: "certificates",
            titleDialog: "Nuevo Certificado",
            loading: false,
            loadingSubmit: false,
            headers: {},
            users: [],
            uploadData: {
                _token: null,
            },
            form: {
                user_id:null,
                description: "",
                file: null,
                file_url: null,
                is_image: false,
                temp_path: null,
            },
            errors: {},
        };
    },
    computed: {
        showImagePreview() {
            if (!this.form.file_url) return false;
            return this.form.is_image || this.isImageFile(this.form.file_url);
        },
        showFileLink() {
            return Boolean(this.form.file_url && !this.showImagePreview);
        },
    },
    methods: {
        initUploadConfig() {
            const token = document
                .querySelector('meta[name="csrf-token"]')
                ?.getAttribute("content");

            this.headers = {
                "X-CSRF-TOKEN": token,
            };

            this.uploadData = {
                _token: token,
            };
        },

        initForm() {
            this.form = {
                user_id: null,
                description: "",
                file: null,
                file_url: null,
                is_image: false,
                temp_path: null,
            };
        },

        async create() {
            this.initUploadConfig();
            this.initForm();
            await this.$http.get(`/${this.resource}/tables`).then(async response => {
                if(response.data.success){
                    console.log("response.data.data",response.data.data);
                    this.users = response.data.data;
                }
            });
            this.errors = {};

            if (this.recordId) {
                this.titleDialog = "Editar Certificado";
                this.getRecord();
            } else {
                this.titleDialog = "Nuevo Certificado";
            }
        },

        handleClose() {
            this.$emit("update:showDialog", false);
            this.initForm();
        },

        onSuccess(response) {
            if (response.success) {
                this.form.file = response.data.filename;
                this.form.file_url = response.data.file_url || null;
                this.form.is_image = Boolean(response.data.is_image);
                this.form.temp_path = response.data.temp_path;
            } else {
                this.$message.error(response.message);
            }
        },

        onUploadError() {
            this.$message.error("Error al subir el archivo");
        },

        async getRecord() {
            this.loading = true;
            try {
                const response = await this.$http.get(
                    `/${this.resource}/record/${this.recordId}`
                );
                if (response.data?.data) {
                    Object.assign(this.form, response.data.data);
                    this.form.is_image = this.isImageFile(
                        this.form.file || this.form.file_url
                    );
                }
            } finally {
                this.loading = false;
            }
        },

        async submit() {
            this.loadingSubmit = true;
            this.errors = {};

            try {
                await this.$http.post(`/${this.resource}`, this.form);
                this.$message.success("Certificado guardado correctamente");
                this.$eventHub.$emit("reloadData");
                this.handleClose();
            } catch (error) {
                if (error.response?.status === 422) {
                    this.errors = error.response.data.errors;
                } else {
                    this.$message.error("Error al guardar");
                }
            } finally {
                this.loadingSubmit = false;
            }
        },
        isImageFile(nameOrUrl) {
            if (!nameOrUrl) return false;
            const match = String(nameOrUrl)
                .toLowerCase()
                .match(/\.([a-z0-9]+)(\?|#|$)/);
            if (!match) return false;
            const ext = match[1];
            return ["jpg", "jpeg", "png", "gif", "svg", "webp"].includes(ext);
        },
    },
};
</script>
<style scoped>
.avatar-uploader .el-upload {
    border: 1px dashed #d9d9d9;
    border-radius: 6px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}
.avatar-uploader-icon {
    font-size: 28px;
    color: #8c939d;
    width: 178px;
    height: 178px;
    line-height: 178px;
    text-align: center;
}
.avatar {
    width: 178px;
    height: 178px;
    display: block;
    object-fit: cover;
}
</style>
