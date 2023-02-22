<template>
    <div class="ms-4">
        <h4 class="text-center">{{mode}} Subject</h4>
        <div class="row">
            <div class="col-md-6">
                <VeeForm :validation-schema="resources.validation" v-slot="{ handleSubmit , isSubmitting}">
                    <form @submit="handleSubmit($event, onSubmit)">
                        <div class="form-group">
                            <label>Name</label>
                            <Field name="name" type="text" v-model="form.name">
                                <input type="text" class="form-control" v-model="form.name">
                                <ErrorMessage name="name" class="text-danger"/>
                            </Field>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">{{mode}} subjects</button>
                    </form>
                </VeeForm>
            </div>
        </div>
    </div>
</template>

<script>
import {Field, Form as VeeForm, ErrorMessage, defineRule} from 'vee-validate';
import addMixin from '../../mixins/add.js';
export default {
    components: {Field, VeeForm, ErrorMessage},
    data() {
        return {
            prefix: 'subjects',
            form : {
                'name': '',
            },
        }
    },
    mixins : [
        addMixin
    ]
}
</script>
