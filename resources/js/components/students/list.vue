<template>
    <div>
        <div class="container-xxl rounded">
            <h4 class="text-center">All students</h4><br/>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Birth day</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(student,index) in this.list.data">
                    <td>{{index + 1}}</td>
                    <td>{{student.name}}</td>
                    <td>{{student.birth_day}}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <router-link :to="{name: 'edit.student', params: { id: student.id }}" class="btn btn-primary">Edit</router-link>
                            <button class="btn btn-danger" @click="deleteItem(student.id)">Delete</button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-4">
                    <button type="button" class="btn btn-info" @click="this.$router.push('/students/add')">Add Student</button>
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
            prefix: 'students'
        }
    },
}
</script>
