<template>
    <div class="container">
        <div class="row">
            <div class="col text-center" v-if="post">
                <h1 class="text-uppercase py-2">
                    {{ post.title }}
                </h1>
                <p class="author">
                    Post by: {{ post.user.name }}
                </p>
                <p class="category" v-if="post.category">
                    {{ post.category.name }}
                </p>

                <p class="tags" v-show="post.tag">
                    <a href="#!"  v-for="tag in post.tags" :key="tag.id" class="tag">
                        {{ tag.name }}
                    </a>
                </p>

                <img :src="post.img_url" :alt="post.title" class="w-50">

                <p class="content pt-3">
                    {{ post.content }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'BlogShow',
    props: ['slug'],
    data() {
        return {
            post: null,
            url: 'http://localhost:8000/api/posts',
        }
    },
    created() {
        this.getData(this.url + '/' + this.slug);

    },
    methods: {
        getData(url) {
            if (url) {
                Axios.get(url)
                .then(res => {
                    if (res.data.success) {
                        this.post =  res.data.response.data;
                        console.log(res.data.success)
                    }
                });
            }
        }
    }

}
</script>

<style scope lang="scss">

</style>
