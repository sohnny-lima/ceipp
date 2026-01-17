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
                    <div class="col-md-8">
                        <div class="row">
                              <div class="col-md-12">
                        <div class="form-group" :class="{ 'has-danger': errors.titulo }">
                            <label class="control-label">Título</label>
                            <el-input v-model="form.titulo"></el-input>
                            <small class="text-danger" v-if="errors.titulo">
                                {{ errors.titulo[0] }}
                            </small>
                        </div>
                    </div>

                    <!-- Subtítulo -->
                    <div class="col-md-12">
                        <div class="form-group" :class="{ 'has-danger': errors.subtitulo }">
                            <label class="control-label">Subtítulo</label>
                            <el-input v-model="form.subtitulo"></el-input>
                            <small class="text-danger" v-if="errors.subtitulo">
                                {{ errors.subtitulo[0] }}
                            </small>
                        </div>
                    </div>

                    <!-- Descripción -->
                    <div class="col-md-12">
                        <div class="form-group" :class="{ 'has-danger': errors.description }">
                            <label class="control-label">Descripción</label>
                            <vue-ckeditor
                                class="course-editor"
                                type="classic"
                                v-model="form.description"
                                :editors="editors"
                                :config="editorConfig">
                            </vue-ckeditor>
                            <small class="text-danger" v-if="errors.description">
                                {{ errors.description[0] }}
                            </small>
                        </div>
                    </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                            <!-- Imagen -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label"></label>
                            <el-upload :action="`/${resource}/upload`" :data="uploadData" :headers="headers" :on-success="onSuccess" :on-error="onUploadError"
                                :show-file-list="false" class="avatar-uploader">
                                <img v-if="form.image_url" :src="form.image_url" class="avatar" />
                                <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                            </el-upload>
                        </div>
                    </div> 
                    </div>
                    <!-- Título -->
                </div>
            </el-form>
        </div>

        <template v-slot:footer>
        <span class="dialog-footer">
            <el-button @click="handleClose">Cancelar</el-button>
            <el-button type="primary" :loading="loadingSubmit" @click="submit"> Guardar</el-button>
        </span>
        </template>
    </el-dialog>
</template>
 
<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import VueCkeditor from "vue-ckeditor5";

export default {
    components: {
        "vue-ckeditor": VueCkeditor.component,
    },
    props: {
        showDialog: {
            type: Boolean,
            default: false,
        },
        recordId: {
            type: [Number, String, null],
            default: null,
        },
    },
    data() {
        return {
            resource: "courses",
            titleDialog: "Nuevo Curso",
            loading: false,
            loadingSubmit: false,
            headers: {},
            uploadData: {
                type: "courses",
                _token: null,
            },
            form: {
                titulo: null,
                subtitulo: null,
                description: "",
                image: null,
                image_url: null,
                temp_path: null,
            },
            errors: {
                titulo: [],
                subtitulo: [],
                description: [],
            },
            editors: {
                classic: ClassicEditor,
            },
            editorConfig: {
                language: "es",
            },
        };
    },
    methods: {
        initUploadConfig() {
            const csrfToken =
                typeof document !== "undefined"
                    ? document
                          .querySelector('meta[name="csrf-token"]')
                          ?.getAttribute("content")
                    : null;
            const baseHeaders =
                typeof window !== "undefined" && window.headers_token
                    ? window.headers_token
                    : {};
            this.headers = csrfToken
                ? { ...baseHeaders, "X-CSRF-TOKEN": csrfToken }
                : { ...baseHeaders };
            this.uploadData = {
                type: "courses",
                _token: csrfToken,
            };
        },
        initForm() {
            this.form = {
                titulo: null,
                subtitulo: null,
                description: "",
                image: null,
                image_url:null,
                temp_path: null,
            };
        },
         onSuccess(response, file, fileList) {
            if (response.success) {
                this.form.image = response.data.filename;
                this.form.image_url = response.data.temp_image;
                this.form.temp_path = response.data.temp_path;
            } else {
                this.$message.error(response.message);
            }
         },
         onUploadError(error) {
            const message =
                (error && error.message) || "Error al subir la imagen";
            this.$message.error(message);
         },
        create() {
            this.initUploadConfig();
            this.initForm();
            this.errors = {};

            if (this.recordId) {
                this.titleDialog = "Editar Curso";
                this.getRecord();
            } else {
                this.titleDialog = "Nuevo Curso";
            }
        },

        handleClose() {
            this.$emit("update:showDialog", false);
            this.initForm();
        },

        // onFileChange(file) {
        //     const rawFile = file && file.raw ? file.raw : file;
        //     if (!rawFile) return;
        //     if (this.form.image_url && this.form.image_url.startsWith("blob:")) {
        //         URL.revokeObjectURL(this.form.image_url);
        //     }
        //     this.form.image = rawFile;
        //     this.form.image_url = URL.createObjectURL(rawFile);
        // },

        async getRecord() {
            this.loading = true;
            try {
                const response = await this.$http.get(
                    `/${this.resource}/record/${this.recordId}`
                );
                if (response.data && response.data.data) {
                    Object.assign(this.form, response.data.data);
                }
            } catch (error) {
                this.$message.error("No se pudo cargar el curso.");
            } finally {
                this.loading = false;
            }
        },

        async submit() {
            this.loadingSubmit = true;
            this.errors = {};

           

            try {
                const response = await this.$http.post(`/${this.resource}`,this.form);
                this.$message.success("Curso guardado correctamente");
                this.$eventHub.$emit("reloadData");
                this.handleClose();
            } catch (error) {
                if (error.response && error.response.status === 422) {
                    this.errors = error.response.data.errors;
                } else {
                    this.$message.error("Error al guardar el curso");
                }
            } finally {
                this.loadingSubmit = false;
            }
        },
    },
};
</script>
<style scoped>
 
.course-editor /deep/ .ck-editor__editable,
.course-editor /deep/ .ck-editor__editable_inline {
    min-height: 240px;
}
</style>
