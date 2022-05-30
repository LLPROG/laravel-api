<template>
    <div>
        <div class="cont-card">
            <div class="row text-center">
                <div class="col">
                    Pagina Corrente: {{  this.currentPageNumber }}
                </div>
            </div>
            <div class="row g-3">
                <div class="col-4" v-for="post in posts" :key="post.slug">

                    <!-- card -->
                    <div class="my card m-2 border border-2 h-100 w-100 p-2">
                        <h1>
                            {{ post.title }}
                        </h1>
                        <p>
                            {{ post.content }}
                        </p>
                        <p>
                            Post By:
                        </p>

                        <router-link :to="{name: 'blogShow', params: {slug: post.slug}}" class="btn btn-primary mb-auto">
                            Read more
                        </router-link>
                    </div>

                </div>
            </div>

        </div>

        <div class="d-flex justify-content-center mt-3">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item" :class="{ disabled: prevPageUrl == null}">
                        <a class="page-link" @click="getData(prevPageUrl)">Previous</a>
                    </li>

                    <li class="page-item"><a class="page-link">1</a></li>
                    <li class="page-item"><a class="page-link">2</a></li>
                    <li class="page-item"><a class="page-link">3</a></li>
                    <li class="page-item"><a class="page-link">4</a></li>
                    <li class="page-item"><a class="page-link">5</a></li>

                    <li class="page-item" :class="{ disabled: nextPageUrl == null}">
                        <a class="page-link" @click="getData(nextPageUrl)">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
export default {
    name: 'BlogIndex',
    data() {
        return {
            posts: [],
            prevPageUrl: null,
            nextPageUrl: null,
            firstPageUrl: null,
            lastPageUrl: null,
            currentPageNumber: null,
            path: 'http://127.0.0.1:8000/api/posts'
        }
    },
    methods: {
        getData(url) {
            Axios.get(url).then(response => {
                this.posts = response.data.response.data;

                this.prevPageUrl = response.data.response.prev_page_url;
                this.nextPageUrl = response.data.response.next_page_url;

                this.firstPageUrl = response.data.response.first_page_url;
                this.lastPageUrl = response.data.response.last_page_url;

                this.currentPageNumber = response.data.response.current_page;

            })
        },
    },
    created () {
        this.getData(this.path)
    }
}
</script>

<style scope lang="scss">
    .pagination {
        li {
            cursor: pointer;
        }
    }
</style>
