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
                            <th>Descripción</th>
                            <th>Archivo</th>
                            <th>Usuario</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </template>

                    <!-- ROWS -->
                    <template #default="{ index, row }">
                        <tr>
                            <td>{{ index }}</td>
                            <td v-text="stripHtml(row.description)"></td>

                            <td>
                                <span v-if="row.file">
                                    {{ row.file.split('/').pop() }}
                                </span>
                                <span v-else>-</span>
                            </td>
                            <td>
                                {{ row.user_name || '-' }}
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
            <certificate-form
                :showDialog.sync="showDialog"
                :recordId="recordId"
            />
        </div>
    </div>
</template>

<script>
import CertificateForm from "./form.vue";
import DataTable from "../../components/DataTable.vue";
import { deletable } from "../../mixins/deletable";

export default {
    components: {
        CertificateForm,
        DataTable,
    },
    mixins: [deletable],
    data() {
        return {
            description: "Certificados",
            showDialog: false,
            resource: "certificates",
            recordId: null,
        };
    },
    created() {
        this.title = "Certificados";
    },
    methods: {
        stripHtml(value) {
            if (!value) return "";
            return String(value)
                .replace(/<[^>]*>/g, "")
                .replace(/&nbsp;/g, " ")
                .trim();
        },

        clickCreate(recordId = null) {
            this.recordId = recordId;
            this.showDialog = true;
        },

        clickDelete(id) {
            this.destroy(`/${this.resource}/${id}`).then(() => {
                this.$eventHub.$emit("reloadData");
            });
        },
    },
};
</script>