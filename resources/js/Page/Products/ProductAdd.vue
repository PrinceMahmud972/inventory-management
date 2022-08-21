<template>

    <div class="card card-primary card-outline">
        <div class="card-body">
            <h5 class="card-title">Create Product</h5><br>
            <div>
                <!-- form start -->
            <form action="" method="post">
            <div class="card-body">
                <div class="form-group">
                    <label>Category</label>
                    <select name="category_id" class="form-control select2" v-model="form.category_id">
                        <option :value="item.id" v-for="(item, index) in categories" :key="index">
                            {{ item.name }}
                        </option>
                    </select>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Submit</button>
            </div>
            </form>
            </div>
        </div>
    </div><!-- /.card -->

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
                }
            }
        },
        computed: {
            ...mapGetters({
                'categories': 'getCategories'
            })
        },
        mounted() {
            store.dispatch(actions.GET_CATEGORIES);
        }
    }
</script>