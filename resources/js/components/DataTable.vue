<template>
  <div>
    <div class="row">
         
          <div class="col-md-12 p-1">
            <div class="input-group">
                <div class="input-group-prepend">
                  <el-select
                      v-model="search.column"
                      placeholder="Select"
                      @change="changeClearInput"
                    >
                      <el-option
                        v-for="(label, key) in columns"
                        :key="key"
                        :value="key"
                        :label="label"
                      ></el-option>
                    </el-select>
                </div>
                <input type="text" class="form-control form-control-sm" v-model="search.value" @keyup="getRecords" @keyup.enter="getRecords"/> 
                
                <div class="input-group-append" id="button-addon2">
                  <el-button type="primary" plain  icon="el-icon-search" @click="getRecords">Buscar</el-button>
                </div>
            </div>    
          </div>
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table"  v-loading="loading">
            <thead>
              <slot name="heading"></slot>
            </thead>
            <tbody>
              <slot
                v-for="(row, index) in records"
                :row="row"
                :index="customIndex(index)"
              ></slot>
            </tbody>
          </table>
          <div>
            <el-pagination
              @current-change="getRecords"
              layout="total, prev, pager, next"
              :total="pagination.total"
              :current-page.sync="pagination.current_page"
              :page-size="pagination.per_page"
            >
            </el-pagination>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import moment from "moment";
import queryString from "query-string";

export default {
  props: {
    resource: String,
  },
  data() {
    return {
      search: {
        column: null,
        value: null,
      },
      columns: [],
      records: [],
      pagination: {},
      array_district: [],
      loading:false
    };
  },
  computed: {},
  created() {
    this.$eventHub.$on("reloadData", () => {
      this.getRecords();
    });
  },
  async mounted() {
    let column_resource = _.split(this.resource, "/");
    // console.log(column_resource)
    await this.$http
      .get(`/${_.head(column_resource)}/columns`)
      .then((response) => {
        this.columns = response.data;
        this.search.column = _.head(Object.keys(this.columns));
      });
    await this.getRecords();
  },
  methods: {
    customIndex(index) {
      return (
        this.pagination.per_page * (this.pagination.current_page - 1) +
        index +
        1
      );
    },
    getRecords() {
      this.loading = true;
      return this.$http
        .get(`/${this.resource}/records?${this.getQueryParameters()}`)
        .then((response) => {
          this.loading = false;          
          this.records = response.data.data;
          this.pagination = response.data.meta;
          this.pagination.per_page = parseInt(response.data.meta.per_page);
        });
    },
    getQueryParameters() {
      return queryString.stringify({
        page: this.pagination.current_page,
        limit: this.limit,
        ...this.search,
      });
    },
    changeClearInput() {
      this.search.value = "";
      this.getRecords();
    },
  },
};
</script>
