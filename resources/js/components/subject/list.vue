<template>
    <div>
        <h4 class="text-center">All subjects</h4><br/>
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
                <td>{{list.last_page}}</td>
                <td>
                    <div class="btn-group" role="group">
                        <!--                        <router-link :to="{name: 'editbook', params: { id: student.id }}" class="btn btn-primary">Edit-->
                        <!--                        </router-link>-->
                        <button class="btn btn-danger" @click="deleteItem(subject.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-info" @click="this.$router.push('/books/add')">Add Book</button>
    </div>
    <Paginate
        :page-count="this.list.last_page"
        :page-range="3"
        :margin-pages="2"
        :click-handler="onClickPaginate"
        prev-text="<i class='bx bx-skip-previous' ></i>"
        next-text="<i class='bx bx-skip-next' ></i>"
        :container-class="'pagination'"
        :page-class="'page-item'"
    />
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
    // created() {
    //     this.$axios.get('/sanctum/csrf-cookie').then(response => {
    //         this.$axios.get('/api/books')
    //             .then(response => {
    //                 this.books = response.data;
    //             })
    //             .catch(function (error) {
    //                 console.error(error);
    //             });
    //     })
    // },

    methods: {

        getList(page = null) {
            let sendData = {
                page : page ? page : this.list.current_page,
                limit: 2
            }
            axios.post('/api/subjects', sendData)
                .then(response => {
                    if(response.status == 200) {
                        for(let k in this.list){
                            if(response.data[k] != undefined){
                                this.list[k] = response.data[k];
                            }
                        }
                    }
                })
                .catch(function (error) {
                    console.error(error);
                });
        },
        deleteBook(id) {
            // this.$axios.get('/sanctum/csrf-cookie').then(response => {
            //     this.$axios.delete(`/api/books/delete/${id}`)
            //         .then(response => {
            //             let i = this.books.map(item => item.id).indexOf(id); // find index of your object
            //             this.books.splice(i, 1)
            //         })
            //         .catch(function (error) {
            //             console.error(error);
            //         });
            // })
            axios.delete(`/api/subjects/delete/${id}`)
                    .then(response => {
                        this.getList()
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
        },


    },
    // beforeRouteEnter(to, from, next) {
    //     if (!window.Laravel.isLoggedin) {
    //         window.location.href = "/";
    //     }
    //     next();
    // }
}
</script>
