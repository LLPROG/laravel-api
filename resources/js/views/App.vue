
<template>
    <div class="container">
        <card-container />
    </div>
</template>

<script>
// import Axios from 'axios';
import CardContainer from '../components/CardContainer.vue';
import PaginationComp from '../components/PaginationComp.vue';

export default {
    name: 'App',
    components: {
        CardContainer,
        PaginationComp,

    }
}
</script>

<style scoped>

</style>
