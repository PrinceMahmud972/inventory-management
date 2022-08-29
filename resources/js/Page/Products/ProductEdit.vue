<template>
    <!-- form start -->
        <form @submit.prevent="submitForm" method="post">
            <div class="row">
                <show-error></show-error>
                <div class="col-lg-6">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h5 class="card-title">Update Product</h5><br>
                            <div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label>Category <span class="text-danger">*</span></label>
                                    <select
                                        class="form-control"
                                        name="form.category_id"
                                        v-model="form.category_id"
                                        >
                                        <option
                                            :value="item.id"
                                            v-for="(item, index) in categories"
                                            :key="index"
                                            >
                                            {{ item.name }}
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Brand <span class="text-danger">*</span></label>
                                    <select name="brand_id" class="form-control" v-model="form.brand_id">
                                        <option :value="item.id" v-for="(item, index) in brands" :key="index">
                                            {{ item.name }}
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">SKU <span class="text-danger">*</span></label>
                                    <input type="text" v-model="form.sku" class="form-control" placeholder="SKU">
                                </div>

                                <div class="form-group">
                                    <label for="">Name <span class="text-danger">*</span></label>
                                    <input type="text" v-model="form.name" class="form-control" placeholder="Product Name">
                                </div>

                                <div class="form-group">
                                    <label for="">Image <span class="text-danger">*</span></label>
                                    <img :src="product.product_image" alt="" class="img-fluid w-25 mb-2">
                                    <input type="file" @change="selectImage" class="form-control" placeholder="Product Image">
                                </div>

                                <div class="form-group">
                                    <label for="">Cost Price($) <span class="text-danger">*</span></label>
                                    <input type="text" v-model="form.cost_price" class="form-control" placeholder="Product Cost Price">
                                </div>

                                <div class="form-group">
                                    <label for="">Sell Price($) <span class="text-danger">*</span></label>
                                    <input type="text" v-model="form.sell_price" class="form-control" placeholder="Product Sell Price">
                                </div>

                                <div class="form-group">
                                    <label for="">Year(EX: 2022) <span class="text-danger">*</span></label>
                                    <input type="text" v-model="form.year" class="form-control" placeholder="Product Manufactured Year">
                                </div>

                                <div class="form-group">
                                    <label for="">Description <span class="text-danger">*</span></label>
                                    <input type="text" v-model="form.description" class="form-control" placeholder="Product Description [Max: 200]">
                                </div>

                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="" id="" class="form-control" v-model="form.status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
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

                            <div class="row mb-3" v-for="(item, index) in form.items" :key="index">
                                <div class="col-md-4">
                                    <select name="" id="" class="form-control" v-model="item.size_id">
                                        <option value="">Select Size</option>
                                        <option v-for="(size, index) in sizes" :key="index" :value="size.id">{{ size.size }}</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" v-model="item.location" class="form-control" placeholder="Location">
                                </div>
                                <div class="col-md-4">
                                    <input type="number" v-model="item.quantity" class="form-control" placeholder="Quantity">
                                </div>
                                <div class="">
                                    <button class="btn btn-danger btn-sm" @click.prevent="deleteItem(index)"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>

                            <button class="btn btn-success mt-3" @click.prevent="addItem"><i class="fa fa-plus"></i> Add Item</button>
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
            name: 'ProductAdd',
            components: {
                ShowError
            },
            props:['product'],
            data() {
                return {
                    form: {
                        category_id: '',
                        brand_id: '',
                        sku: '',
                        name: '',
                        image: '',
                        cost_price: 0,
                        sell_price: 0,
                        year: '',
                        description: '',
                        status: 1,
                        items: [
                            {
                                size_id: '',
                                location: '',
                                quantity: 0
                            }
                        ]
                    }
                }
            },
            methods: {
                selectImage(e) {
                    this.form.image = e.target.files[0];
                },
                addItem() {
                    let item = {
                        size_id: '',
                        location: '',
                        quantity: 0
                    }
                    this.form.items.push(item);
                },
                deleteItem(index) {
                    this.form.items.splice(index, 1);
                },
                submitForm() {
                    let data = new FormData();
                    data.append('_method', 'PUT');
                    data.append('category_id', this.form.category_id);
                    data.append('brand_id', this.form.brand_id);
                    data.append('sku', this.form.sku);
                    data.append('name', this.form.name);
                    data.append('image', this.form.image);
                    data.append('cost_price', this.form.cost_price);
                    data.append('sell_price', this.form.sell_price);
                    data.append('year', this.form.year);
                    data.append('description', this.form.description);
                    data.append('status', this.form.status);
                    data.append('items', JSON.stringify(this.form.items));

                    let payload = {
                        data: data,
                        id: this.product.id
                    }

                    store.dispatch(actions.EDIT_PRODUCTS, payload);
                }

            },
            computed: {
                ...mapGetters({
                    'categories': 'getCategories',
                    'brands': 'getBrands',
                    'sizes': 'getSizes',
                })
            },
            mounted() {
                store.dispatch(actions.GET_CATEGORIES);
                store.dispatch(actions.GET_BRANDS);
                store.dispatch(actions.GET_SIZES);

                // Set old data
                this.form.category_id = this.product.category_id;
                this.form.brand_id = this.product.brand_id;
                this.form.sku = this.product.sku;
                this.form.name = this.product.name;
                this.form.cost_price = this.product.cost_price;
                this.form.sell_price = this.product.sell_price;
                this.form.year = this.product.year;
                this.form.description = this.product.description;
                this.form.status = this.product.status;
                this.form.items = this.product.product_stocks;
            }
        }
    </script>