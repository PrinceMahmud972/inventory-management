<template>
<!-- form start -->
    <form @submit.prevent="submitForm" method="post">
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h5 class="card-title">Create Product</h5><br>
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
                                <input type="file" class="form-control" placeholder="Product Image">
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
                                <button class="btn btn-danger btn-sm" @click="deleteItem(index)"><i class="fa fa-trash"></i></button>
                            </div>
                        </div>

                        <button class="btn btn-success mt-3" @click="addItem"><i class="fa fa-plus"></i> Add Item</button>
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
    export default {
        name: 'ProductAdd',
        data() {
            return {
                form: {
                    category_id: 0,
                    brand_id: 0,
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
                console.log(this.form)
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
        }
    }
</script>