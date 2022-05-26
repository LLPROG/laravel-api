<template>
    <div>
        <div class="cont-card">
            <div class="row">
                <div class="col">
                    Pagina Corrente: {{  this.currentPageNumber }}
                </div>
            </div>
            <div class="row g-3">
                <div class="col-3" v-for="post in posts" :key="post.slug">
                    <div class="my card m-2 border border-2 h-100 w-100">
                        <h1>
                            {{ post.title }}
                        </h1>
                        <h3>
                            {{ post.id }}
                        </h3>
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

                    <li class="page-item">
                        <a class="page-link" :class="{ disabled: prevPageUrl == null}" @click="getData(nextPageUrl)">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
export default {
    name: 'CardContainer',
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
        }
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
