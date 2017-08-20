<template>
    <div class="panel">
        <div class="panel-heading border">
            Blogs
            <div class="panel-controls">
                <router-link to="/create" class="btn btn-primary btn-xs">
                    Create A Blog
                </router-link>
            </div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-condensed responsive mb0" data-sortable="" data-sortable-initialized="true">
                    <thead>
                    <tr>
                        <th width="20%">Title</th>
                        <th width="20%">Slug</th>
                        <th width="10%">Author</th>
                        <th width="20%">Created At</th>
                        <th width="20%">Updated At</th>
                        <th width="10%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="blog in blogs">
                        <td><a :href="'/blogs/' + blog.slug + '/read'" target="_blank">{{ blog.title }}</a></td>
                        <td>{{ blog.slug }}</td>
                        <td>{{ blog.user.first_name + ' ' + blog.user.last_name }}</td>
                        <td>{{ blog.created_at }}</td>
                        <td>{{ blog.updated_at }}</td>
                        <td>
                            <button @click="onEdit(blog.id)" class="btn btn-primary btn-xs">
                                <i class="fa fa-pencil-square-o"></i>
                            </button>
                            <button @click="onDelete(blog.id)" class="btn btn-danger btn-xs">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                resourceUrl: '/blogs',
                blogs: [],
            };
        },
        methods: {
            refreshList: function () {
                const inst = this;
                Axios.get(this.resourceUrl + '/list')
                    .then(function (response) {
                        inst.blogs = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                        swal('Error', 'Can not get list!', 'error');
                    })
            },
            onDelete: function (id) {
                const inst = this;
                swal({
                        title: 'Are you sure?',
                        text: 'You will not be able to recover this blog!',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'Yes, delete!',
                        closeOnConfirm: false,
                    },
                    function () {
                        Axios.delete(inst.resourceUrl + '/' + id)
                            .then(function (response) {
                                inst.refreshList();
                                swal('Deleted!', 'Blog deleted!', 'success');
                            })
                            .catch(function (error) {
                                console.log(error);
                                swal('Error', 'Delete failed!', 'error');
                            });
                    });
            },
            onEdit: function (id) {
                this.$router.push('/edit/' + id);
            }
        },
        mounted: function () {
            this.refreshList();
        }
    }
</script>

<style>

</style>