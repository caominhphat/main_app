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
            <tr v-for="(subject,index) in subjects">
                <td>{{index + 1}}</td>
                <td>{{subject.name}}</td>
                <td>
                    <div class="btn-group" role="group">
                        <!--                        <router-link :to="{name: 'editbook', params: { id: student.id }}" class="btn btn-primary">Edit-->
                        <!--                        </router-link>-->
                        <button class="btn btn-danger" @click="deleteBook(subject.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-info" @click="this.$router.push('/books/add')">Add Book</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            subjects: []
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
    mounted() {
        this.getList();
    },
    methods: {
        getList() {
            axios.get('/api/subjects')
                .then(response => {
                    if(response.status == 200) {
                        this.subjects = response['data'] ? response['data'] : [];
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
        }
    },
    // beforeRouteEnter(to, from, next) {
    //     if (!window.Laravel.isLoggedin) {
    //         window.location.href = "/";
    //     }
    //     next();
    // }
}
</script>
