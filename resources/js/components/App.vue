<template>
    <div v-if="article" class="alert alert-success">
        🆕 Добавлена новая статья:
        <a :href="`/article/${article.id}`" class="alert-link">
            {{ article.title }}
        </a>
    </div>
</template>


<script>
        export default {
        data() { return { 
            article: null,
         } },
            created() {
                window.Echo.channel('articles').listen('NewArticleEvent', (data) => {
                    console.log(data.article);
                    this.article=data.article;
                    // alert('Добавлена новая статья!');
                })
            }
        }
    </script>
