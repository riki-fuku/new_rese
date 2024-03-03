<template>

    <!-- 検索フォーム -->
    <div class="md:flex md:justify-end z-0">
        <div class="m-5 p-3 drop-shadow-lg rounded-xl bg-white">
            <div class="inline px-2 border-r-2 border-gray-300">
                <select class="border-none" v-model="selectedArea">
                    <option value="0">All area</option>
                    <option v-for="(name, id) in areas" :value="id">{{ name }}</option>
                </select>
            </div>

            <div class="inline px-2 md:border-r-2 md:border-gray-300">
                <select class="border-none" v-model="selectedGenre">
                    <option value="0" key="0">All genre</option>
                    <option v-for="(name, id) in genres" :value="id" :key="id">{{ name }}</option>
                </select>
            </div>

            <div class="mt-3 md:mt-0 md:inline px-2">
                <i class="fas fa-search text-gray-200"></i>
                <input type="text" class="border-none" placeholder="Search..." v-model.lazy="searchWord">
            </div>

        </div>
    </div>
</template>

<script>
export default {
    props: {
        areas: Object,
        genres: Object,
        search: String,
        areaId: Number,
        genreId: Number,
        word: String,
    },
    data() {
        return {
            selectedArea: this.areaId,
            selectedGenre: this.genreId,
            searchWord: this.word,
        }
    },
    watch: {
        selectedArea(newVal) {
            window.location.href = `/search?area=${newVal}&genre=${this.selectedGenre}&search=${this.searchWord}`;
        },
        selectedGenre(newVal) {
            window.location.href = `/search?area=${this.selectedArea}&genre=${newVal}&search=${this.searchWord}`;
        },
        searchWord(newVal) {
            window.location.href = `/search?area=${this.selectedArea}&genre=${this.selectedGenre}&search=${newVal}`;
        },
    },
}
</script>
