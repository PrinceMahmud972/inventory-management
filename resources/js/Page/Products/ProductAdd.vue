<template>

    <div class="card card-primary card-outline">
        <div class="card-body">
            <h5 class="card-title">Create Product</h5><br>
            <div>
                <!-- form start -->
            <form action="" method="post">
            <div class="card-body">
                <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input name="name" type="text" class="form-control" placeholder="Enter Category Name">

                <span class="error text-danger"></span>
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
    export default {
        name: 'ProductAdd'
    }
</script>