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
    data() {
        return {
            article: null
        }
    },
    mounted() {
        window.Echo.channel('articles')
            .listen('.new-article', (e) => {
                this.article = e.article;
            });
    }
}
</script>
