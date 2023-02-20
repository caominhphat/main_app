<template>
    <div class="ms-4">
        <h4 class="text-center">Add Student</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="onSubmit">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="form.name">
                    </div>
                    <div class="form-group">
                        <label>BirthDay</label>
                        <VueDatePicker v-model="form.birth_day"></VueDatePicker>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Add students</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import addMixin from '../../mixins/add.js'
export default {
    data() {
        return {
            prefix: 'students',
            form : {
                'name': '',
                'birth_day': '',
            }
        }
    },
    mixins : [
        addMixin
    ]
}
</script>
