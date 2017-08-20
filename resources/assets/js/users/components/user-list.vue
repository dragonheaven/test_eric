<template>
    <div class="panel">
        <div class="panel-heading border">
            Users
            <div class="panel-controls">
                <button @click="onCreate()" class="btn btn-primary btn-xs">
                    Create New User
                </button>
            </div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-condensed responsive mb0" data-sortable="" data-sortable-initialized="true">
                    <thead>
                    <tr>
                        <th width="20%">First Name</th>
                        <th width="20%">Last Name</th>
                        <th width="10%">Timezone</th>
                        <th width="20%">Email</th>
                        <th width="20%">Created At</th>
                        <th width="10%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in users">
                        <td>{{ user.first_name }}</td>
                        <td>{{ user.last_name }}</td>
                        <td>{{ user.timezone }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.created_at }}</td>
                        <td>
                            <button @click="onEdit(user.id)" class="btn btn-primary btn-xs">
                                <i class="fa fa-pencil-square-o"></i>
                            </button>
                            <button @click="onDelete(user.id)" class="btn btn-danger btn-xs">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- modal create -->
        <div class="modal fade" id="modal_create" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5>Create User</h5>
                    </div>
                    <div class="modal-body">
                        <form role="form">
                            <div class="form-group" :class="{'has-error': errors.has('first_name')}">
                                <label>First Name</label>
                                <input type="text" class="form-control" v-model="createData.first_name"  placeholder="First Name">
                                <span class="help-block is-danger"><strong>{{ errors.get('first_name') }}</strong></span>
                            </div>
                            <div class="form-group" :class="{'has-error': errors.has('last_name')}">
                                <label>Last Name</label>
                                <input type="text" class="form-control" v-model="createData.last_name"  placeholder="Last Name">
                                <span class="help-block is-danger"><strong>{{ errors.get('last_name') }}</strong></span>
                            </div>
                            <div class="form-group" :class="{'has-error': errors.has('email')}">
                                <label>Email</label>
                                <input type="email" class="form-control" v-model="createData.email"  placeholder="Email">
                                <span class="help-block is-danger"><strong>{{ errors.get('email') }}</strong></span>
                            </div>
                            <div class="form-group" :class="{'has-error': errors.has('timezone')}">
                                <label>Timezone</label>
                                <select  v-model="createData.timezone" id="createdata_timezone" data-placeholder="Please select timezone" class="form-control chosen">
                                </select>
                                <span class="help-block is-danger"><strong>{{ errors.get('timezone') }}</strong></span>
                            </div>
                            <div class="form-group" :class="{'has-error': errors.has('password')}">
                                <label>Password</label>
                                <input type="password" class="form-control" v-model="createData.password"  placeholder="Password">
                                <span class="help-block is-danger"><strong>{{ errors.get('password') }}</strong></span>
                            </div>
                            <div class="form-group" :class="{'has-error': errors.has('password_confirmation')}">
                                <label>Password Confirmation</label>
                                <input type="password" class="form-control" v-model="createData.password_confirmation"  placeholder="Password Confirmation">
                                <span class="help-block is-danger"><strong>{{ errors.get('password_confirmation') }}</strong></span>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-default pull-left" @click="doCreate()">Create</button>
                        <button class="btn pull-left" @click="doCancelCreate()">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal create end -->
        <!-- modal edit -->
        <div class="modal fade" id="modal_edit" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5>Create User</h5>
                    </div>
                    <div class="modal-body">
                        <form role="form">
                            <div class="form-group" :class="{'has-error': errors.has('first_name')}">
                                <label>First Name</label>
                                <input type="text" class="form-control" v-model="editData.first_name" placeholder="First Name">
                                <span class="help-block is-danger"><strong>{{ errors.get('first_name') }}</strong></span>
                            </div>
                            <div class="form-group" :class="{'has-error': errors.has('last_name')}">
                                <label>Last Name</label>
                                <input type="text" class="form-control" v-model="editData.last_name" placeholder="Last Name">
                                <span class="help-block is-danger"><strong>{{ errors.get('last_name') }}</strong></span>
                            </div>
                            <div class="form-group" :class="{'has-error': errors.has('email')}">
                                <label>Email</label>
                                <input type="email" class="form-control" v-model="editData.email" placeholder="Email">
                                <span class="help-block is-danger"><strong>{{ errors.get('email') }}</strong></span>
                            </div>
                            <div class="form-group" :class="{'has-error': errors.has('timezone')}">
                                <label>Timezone</label>
                                <select v-model="editData.timezone" id="editdata_timezone" data-placeholder="Please select timezone" class="form-control chosen">
                                </select>
                                <span class="help-block is-danger"><strong>{{ errors.get('timezone') }}</strong></span>
                            </div>
                            <div class="form-group" :class="{'has-error': errors.has('password')}">
                                <label>Password</label>
                                <input type="password" class="form-control" v-model="editData.password" placeholder="Password">
                                <span class="help-block is-danger"><strong>{{ errors.get('password') }}</strong></span>
                            </div>
                            <div class="form-group" :class="{'has-error': errors.has('password_confirmation')}">
                                <label>Password Confirmation</label>
                                <input type="password" class="form-control" v-model="editData.password_confirmation" placeholder="Password Confirmation">
                                <span class="help-block is-danger"><strong>{{ errors.get('password_confirmation') }}</strong></span>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-default pull-left" @click="doEdit()">Update</button>
                        <button class="btn pull-left" @click="doCancelEdit()">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal edit end -->
    </div>
</template>

<script>
    const FormError = require('./../../form-error.vue');
    export default {
        extends: FormError,
        data: function () {
            return {
                resourceUrl: '/users',
                users: [],
                createData: {
                    first_name: '',
                    last_name: '',
                    timezone: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                },
                editData: {
                    id: '',
                    first_name: '',
                    last_name: '',
                    timezone: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                }
            };
        },
        methods: {
            refreshList: function () {
                const inst = this;
                Axios.get(this.resourceUrl + '/list')
                    .then(function (response) {
                        $('#modal_create').modal('hide');
                        inst.users = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            onCreate: function () {
                $('#modal_create').modal();
            },
            doCreate: function() {
                const inst = this;
                inst.errors.deleteAll();
                Axios.post(this.resourceUrl, this.createData)
                    .then(function (response) {
                        inst.refreshList();
                        inst.resetEditData();
                        $('#modal_create').modal('hide');
                        swal('Success', 'Create successful!', 'success');
                    })
                    .catch(function (error){
                        console.log(error);
                        inst.errors.put(error.response.data);
                        swal('Error', 'Create failed!', 'error');
                    });
            },
            doCancelCreate: function() {
                this.resetEditData();
                $('#modal_create').modal('hide');
            },
            onEdit: function (id) {
                const inst = this;
                Axios.get(inst.resourceUrl + '/' + id)
                    .then(function (response) {
                        inst.editData = response.data;
                        $('#editdata_timezone').val(inst.editData.timezone).trigger('chosen:updated');
                        $('#modal_edit').modal();
                    })
                    .catch(function (error) {
                        console.log(error);
                        swal('Error', 'Edit failed!', 'error');
                    });
            },
            doEdit: function() {
                const inst = this;
                inst.errors.deleteAll();
                Axios.post(inst.resourceUrl + '/' + inst.editData.id, inst.editData)
                    .then(function (response) {
                        inst.refreshList();
                        inst.resetEditData();
                        $('#modal_edit').modal('hide');
                        swal('Success', 'Edit successful!', 'success');
                    })
                    .catch(function (error){
                        console.log(error);
                        inst.errors.put(error.response.data);
                        swal('Error', 'Edit failed!', 'error');
                    });
            },
            doCancelEdit: function() {
                this.resetEditData();
                $('#modal_edit').modal('hide');
            },
            onDelete: function (id) {
                const inst = this;
                swal({
                        title: 'Are you sure?',
                        text: 'You will not be able to recover this user!',
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
                                swal('Deleted!', 'User deleted!', 'success');
                            })
                            .catch(function (error) {
                                console.log(error);
                                swal('Error', 'Delete failed!', 'error');
                            });
                    });
            },
            resetEditData: function () {
                this.createData.first_name = '';
                this.createData.last_name = '';
                this.createData.timezone = '';
                this.createData.email = '';
                this.createData.password = '';
                this.createData.password_confirmation = '';
                this.editData.first_name = '';
                this.editData.last_name = '';
                this.editData.timezone = '';
                this.editData.email = '';
                this.editData.password = '';
                this.editData.password_confirmation = '';
            }
        },
        mounted: function () {
            const inst = this;
            this.refreshList();

            // Add timezones
            $('.chosen').each(function(el){
                var html = '<option value=""></option>';
                for(let i = 0; i < window.timezones.length; i++){
                    html += '<option value="' + window.timezones[i] + '" >' + window.timezones[i] + '</option>';
                }
                $(this).html(html);
            });
            // Chosen plugin
            $('#createdata_timezone').chosen().change(function() {
                inst.createData.timezone = $(this).val();
            });
            $('#editdata_timezone').chosen().change(function() {
                inst.editData.timezone = $(this).val();
            });

            $('.chosen-container').css('width', '100%');
        }
    }
</script>

<style>

</style>