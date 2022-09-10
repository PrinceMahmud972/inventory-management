<template>
    <!-- form start -->
        <form @submit.prevent="submitForm" method="post">
            <div class="row">
                <show-error></show-error>
                <div class="col-lg-6">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h5 class="card-title">Return Product</h5><br>
                            <div>

                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Product <span class="text-danger">*</span></label>
                                        <select
                                            class="form-control"
                                            name="form.product_id"
                                            v-model="form.product_id"
                                            @change="selectedProduct"
                                            >
                                            <option
                                                :value="item.id"
                                                v-for="(item, index) in products"
                                                :key="index"
                                                >
                                                {{ item.name }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" v-model="form.date">
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Submit</button>
                                </div>

                            </div>
                        </div>
                    </div><!-- /.card -->
                </div>
                <div class="col-lg-6">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h5 class="card-title">Product Sizes</h5><br><br>

                            <table class="table table-sm">
                                <tr v-for="(item, index) in form.items" :key="index">
                                    <td>{{ item.size }}</td>
                                    <td>
                                        <input type="text" class="form-control" v-model="item.quantity" placeholder="Quantity">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </template>

    <script>
        import {mapGetters} from 'vuex'
        import store from '../../store'
        import * as actions from '../../store/action-types'
        import ShowError from '../utils/ShowError.vue'
        export default {
            name: 'StockManage',
            components: {
                ShowError
            },
            data() {
                return {
                    form: {
                        date: '',
                        product_id: '',
                        items: []
                    }
                }
            },
            methods: {
                selectedProduct() {
                    this.form.items = [];
                    let product = this.products.filter(item => item.id == this.form.product_id);
                    product = JSON.parse(JSON.stringify(product));
                    product[0].product_stocks.map(stock => {
                        let item = {
                            size: stock.size.size,
                            size_id: stock.size_id,
                            quantity: ''
                        }

                        this.form.items.push(item);
                    });
                },
                submitForm() {
                    store.dispatch(actions.SUBMIT_RETURN_PRODUCT, this.form);
                }
            },
            computed: {
                ...mapGetters({
                    'products': 'getProducts',
                })
            },
            mounted() {
                store.dispatch(actions.GET_PRODUCTS);
            }
        }
    </script>