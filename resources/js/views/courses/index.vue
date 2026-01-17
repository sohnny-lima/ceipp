<template>
    <div>
        <!-- HEADER -->
        <div class="page-header pr-0">
            <h2>
                <a href="/dashboard">
                    <i class="fas fa-tachometer-alt"></i>
                </a>
            </h2>

            <ol class="breadcrumbs">
                <li class="active">
                    <span>{{ description }}</span>
                </li>
            </ol>

            <div class="right-wrapper pull-right">
                <button
                    type="button"
                    class="btn btn-custom btn-sm mt-2 mr-2"
                    @click.prevent="clickCreate()"
                >
                    <i class="fa fa-plus-circle"></i> Nuevo
                </button>
            </div>
        </div>

        <!-- TABLE -->
        <div class="card mb-0">
            <div class="card-header">
                <h3 class="my-0">{{ description }}</h3>
            </div>

            <div class="card-body">
                <data-table :resource="resource">
                    <!-- HEADERS -->
                    <template #heading>
                        <tr>
                            <th>#</th>
                            <th>Título</th>
                            <th>Subtítulo</th>
                            <th>Descripción</th>
                            <th>Imagen</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </template>

                    <template #default="{ index, row }">
                        <tr>
                            <td>{{ index }}</td>
                            <td>{{ row.titulo }}</td>
                            <td>{{ row.subtitulo }}</td>
                            <td v-text="stripHtml(row.description)"></td>
                            <td>
                                <img
                                    v-if="row.image_url"
                                    :src="row.image_url"
                                    alt="Imagen"
                                    height="50"
                                    class="image-thumb"
                                    @click="openImagePreview(row.image_url)"
                                />
                                <span v-else>
                                    <i class="fas fa-image"></i>
                                </span>
                            </td>
                            <td class="text-end">
                                <button
                                    type="button"
                                    class="btn btn-sm btn-info"
                                    @click.prevent="clickCreate(row.id)"
                                >
                                    Editar
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-sm btn-danger"
                                    @click.prevent="clickDelete(row.id)"
                                >
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    </template>
                </data-table>
            </div>

            <!-- FORM -->
            <course-form :showDialog.sync="showDialog"
                :recordId="recordId">
                </course-form>
        </div>
        <div
            v-if="imagePreviewVisible"
            class="image-preview-overlay"
            @click="closeImagePreview"
        >
            <div class="image-preview-modal" @click.stop>
                <button
                    type="button"
                    class="image-preview-close"
                    aria-label="Cerrar"
                    @click="closeImagePreview"
                >
                    ×
                </button>
                <img
                    v-if="imagePreviewSrc"
                    :src="imagePreviewSrc"
                    alt="Vista previa"
                    class="image-preview-img"
                />
            </div>
        </div>
    </div>
</template>

<script>
import CourseForm from './form.vue'
import DataTable from '../../components/DataTable.vue'
//components/DataTable.vue'
import { deletable } from '../../mixins/deletable'

export default {
    components: {
        CourseForm,
        DataTable,
    },
    mixins: [deletable],
    data() {
        return {
            description: 'Cursos',
            showDialog: false,
            resource: 'courses',
            recordId: null,
            imagePreviewVisible: false,
            imagePreviewSrc: null,
        }
    },
    created() {
        this.title = 'Cursos'
    },
    methods: {
        stripHtml(value) {
            if (!value) {
                return "";
            }
            return String(value).replace(/<[^>]*>/g, "").replace(/&nbsp;/g, " ").trim();
        },
        clickCreate(recordId = null) {
            this.recordId = recordId
            this.showDialog = true
        },

        clickDelete(id) {
            this.destroy(`/${this.resource}/${id}`).then(() => {
                this.$eventHub.$emit('reloadData')
            })
        },
        openImagePreview(src) {
            this.imagePreviewSrc = src
            this.imagePreviewVisible = true
        },
        closeImagePreview() {
            this.imagePreviewVisible = false
            this.imagePreviewSrc = null
        },
    },
}
</script>
<style scoped>
.image-thumb {
    cursor: zoom-in;
}

.image-preview-img {
    max-width: 90vw;
    max-height: 90vh;
    width: auto;
    height: auto;
    animation: image-zoom-in 0.2s ease-out;
}

@keyframes image-zoom-in {
    from {
        transform: scale(0.9);
        opacity: 0.6;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

.image-preview-overlay {
    position: fixed;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(0, 0, 0, 0.6);
    z-index: 2000;
    padding: 16px;
}

.image-preview-modal {
    position: relative;
    background: #ffffff;
    padding: 16px;
    border-radius: 8px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
}

.image-preview-close {
    position: absolute;
    top: 8px;
    right: 8px;
    width: 32px;
    height: 32px;
    border: none;
    border-radius: 50%;
    background: #ffffff;
    color: #333333;
    font-size: 20px;
    line-height: 32px;
    text-align: center;
    cursor: pointer;
    z-index: 1;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

.image-preview-close:hover {
    background: #f5f5f5;
}
</style>
