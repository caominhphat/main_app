<template>
    <div class="container-xxl rounded">
        <h4 class="text-center" id="here">All subjects</h4><br/>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(subject,index) in this.list.data">
                <td>{{index + 1}}</td>
                <td>{{subject.name}}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit.subject', params: { id: subject.id }}" class="btn btn-primary">Edit</router-link>
                        <button class="btn btn-danger" @click="deleteItem(subject.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-4">
                <button type="button" class="btn btn-info" @click="this.$router.push('/addSubject')">Add Subject</button>
            </div>
            <div class="col-md-8 d-flex flex-row-reverse">
                <Paginate
                    v-model="this.list.current_page"
                    :page-count="this.list.last_page"
                    :page-range="3"
                    :margin-pages="2"
                    :click-handler="onClickPaginate"
                    prev-text="Previous"
                    next-text="Next"
                    :container-class="'pagination'"
                    :page-class="'page-item'"
                />
            </div>
        </div>
    </div>
</template>

<script>
import ListMixin from '../../mixins/list.js'
export default {
    mixins: [
        ListMixin
    ],
    data() {
        return {
            prefix: 'subjects'
        }
    },

    methods: {

        // getList(page = null) {
        //     let sendData = {
        //         page : page ? page : this.list.current_page,
        //         limit: 2
        //     }
        //
        //     this.$helper.post('subjects', sendData)
        //         .then(response => {
        //             if(response.data.length > 0) {
        //                 for(let k in this.list){
        //                     if(response[k] != undefined){
        //                         this.list[k] = response[k];
        //                     }
        //                 }
        //             }
        //         })
        //         .catch(function (error) {
        //             console.error(error);
        //         });
        // },


    },
}
</script>
