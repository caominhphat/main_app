<template>
    <div>
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
<!--                        <router-link :to="{name: 'editbook', params: { id: student.id }}" class="btn btn-primary">Edit-->
<!--                        </router-link>-->
                        <button class="btn btn-danger" @click="deleteItem(student.id)">Delete</button>
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
        prev-text="Next"
        next-text="Previous"
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
            prefix: 'students'
        }
    },
}
</script>
