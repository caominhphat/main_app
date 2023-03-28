<template>
    <div class="ms-4">
        <h4 class="text-center">{{mode}} Student</h4>
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

                        <div class="form-group">
                            <label>Birth day</label>
                            <Field name="birth_day" v-model="form.birth_day">
                                <VueDatePicker autoApply :enableTimePicker="false"
                                               :format="$helper.Enum.DATE_FORMAT_SHORT"
                                               v-model="form.birth_day"></VueDatePicker>
                                <ErrorMessage name="birth_day" class="text-danger"/>
                            </Field>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">File học sinh</label>
                            <input class="form-control" type="file" ref="fileInput" @change="onChangeFiles($event.target)">
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">{{mode}} students</button>
                    </form>

                </VeeForm>
            </div>
        </div>
    </div>
</template>

<script>
import {Field, Form as VeeForm, ErrorMessage, defineRule} from 'vee-validate';
import {saveAs} from 'file-saver';
import addMixin from '../../mixins/add.js';
export default {
    components: {Field, VeeForm, ErrorMessage},
    data() {
        return {
            prefix: 'students',
            form : {
                'name': '',
                'birth_day': '',
                'file': null,
                'file_refs': [],
            },
            schema: {
                'name' : 'required',
                'birth_day' : 'required'
            }
        }
    },

    methods:{
        onChangeFiles(target){
            let files = target.files;
            if(files.length) {
                for(let i=0; i< files.length; i++){
                    let file = files[i]
                    let fileItem = {
                        index: i,
                        name : file.name,
                        extension: file.name.split(".").pop(),
                    }
                    this.form.file = file;
                }
            }
        },

        onSubmit() {
            let promise;
            let action = '/add';
            let data = Object.assign({}, this.form);
            let apiOptions = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
                'responseType': 'blob'
            }
            let formData = new FormData();
            for (const key in data) {
                formData.append(key, data[key])
            }
            this.beforeSubmit(data);
            if(this.isEditMode()) {
                action = '/edit'
                data.id = this.$route.params.id;
                promise = this.$helper.put(this.prefix + action, formData, apiOptions);

            } else {
                promise =  this.$helper.post(this.prefix + action, formData, apiOptions);
            };

            promise.then(response => {

            })
                .catch(function (error) {
                    console.log(error);
                });
        },
    },
    mixins : [
        addMixin
    ]

}
</script>
