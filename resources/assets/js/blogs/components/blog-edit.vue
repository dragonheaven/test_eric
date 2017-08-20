<template>
    <div class="panel">
        <div class="panel-heading border">
            Edit {{ editData.title }}
        </div>
        <div class="panel-body">
            <form role="form">
                <div class="form-group" :class="{'has-error': errors.has('title')}">
                    <label>Title</label>
                    <input type="text" id="title" class="form-control" v-model="editData.title" placeholder="Title">
                    <span class="help-block is-danger"><strong>{{ errors.get('title') }}</strong></span>
                </div>
                <div class="form-group" :class="{'has-error': errors.has('slug')}">
                    <label>Slug</label>
                    <input type="text" id="slug" class="form-control" v-model="editData.slug" placeholder="Slug">
                    <span class="help-block is-danger"><strong>{{ errors.get('slug') }}</strong></span>
                </div>
                <div class="form-group" :class="{'has-error': errors.has('content')}">
                    <span class="help-block is-danger"><strong>{{ errors.get('content') }}</strong></span>
                    <div id="summernote"></div>
                </div>
                <div class="form-group">
                    <div class="col-md-10 col-md-offset-2">
                        <button type="button" class="btn btn-primary" @click.prevent="onEdit()">Update</button>
                        <a href="javascript:history.back()" class="btn">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    const FormError = require('./../../form-error.vue');
    export default {
        extends: FormError,
        data: function () {
            return {
                resourceUrl: '/blogs',
                editData: {
                    title: '',
                    slug: '',
                    content: '',
                },
            }
        },
        methods: {
            onEdit: function () {
                const inst = this;
                inst.errors.deleteAll();
                Axios.post(inst.resourceUrl + '/' + inst.$route.params.id, inst.editData)
                    .then(function (response) {
                        swal({title: 'Success', text: 'Edit Successful', type: 'success'}
                            , function () {
                                inst.$router.push('/');
                            });
                    })
                    .catch(function (error) {
                        inst.errors.put(error.response.data);
                        swal('Error', 'Edit Failed', 'error');
                    })
            },
            getData: function () {
                const inst = this;
                Axios.get(inst.resourceUrl + '/' + inst.$route.params.id)
                    .then(function (response) {
                        inst.editData = response.data;
                        $('#summernote').summernote('code', inst.editData.content);
                    })
            }
        },
        mounted: function () {
            const inst = this;
            // Summernote
            $('#summernote').summernote({
                callbacks: {
                    onBlur: function () {
                        inst.editData.content = $('#summernote').summernote('code');
                    }
                }
            });

            inst.getData();
        }
    }
</script>

<style>

</style>