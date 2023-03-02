<template>
    <div class="alert" role="alert" v-if="isApiDone" :class="classColor">
        {{ statement }}
    </div>
</template>
<script>
export default {
    props: [
        'statement',
        'isApiDone',
        'classColor'
    ]
}
</script>
