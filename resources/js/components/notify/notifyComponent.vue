<template>
    <div class="alert text-white bg-opacity-50" role="alert" v-if="isApiDone" :class="classColor">
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
