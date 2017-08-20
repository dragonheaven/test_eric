<script>
    class Errors {
        constructor() {
            this.errors = {};
        }

        get(field) {
            if (this.errors[field]) {
                return this.errors[field][0];
            }
        }

        put(errors) {
            this.errors = errors;
        }

        clear(field) {
            if (this.errors[field]) {
                delete this.errors[field];
            }
        }

        has(field) {
            return this.errors.hasOwnProperty(field);
        }

        deleteAll() {
            this.errors = {};
        }
    }

    export default {
        data: function () {
            return {
                errors: new Errors()
            }
        },
    }
</script>