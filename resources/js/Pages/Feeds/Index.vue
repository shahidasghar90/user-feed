<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Feed from '@/Components/Feed.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';
 
defineProps(['feeds']);

const form = useForm({
    message: '',
});
</script>
 
<template>
    <Head title="Feeds" />
 
    <AuthenticatedLayout>
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('feeds.store'), { onSuccess: () => form.reset() })">
                <textarea
                    v-model="form.message"
                    placeholder="What's on your mind?"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
                <InputError :message="form.errors.message" class="mt-2" />
                <PrimaryButton class="mt-4">Feed</PrimaryButton>
            </form>

            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <Feed
                    v-for="feed in feeds"
                    :key="feed.id"
                    :feed="feed"
                />
            </div>

        </div>
    </AuthenticatedLayout>
</template>