<template>
  <AppLayout>
    <div class="container mx-auto px-4 py-8">
      <!-- Category Tabs -->
      <div class="mb-8">
        <div class="flex flex-wrap gap-2 mb-4">
          <button 
            v-for="category in categories" 
            :key="category.id"
            @click="activeCategory = category.id"
            :class="[
              'px-4 py-2 rounded-full text-sm font-medium transition-colors',
              activeCategory === category.id 
                ? 'bg-blue-100 text-blue-700' 
                : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
            ]"
          >
            {{ category.name }}
          </button>
        </div>
      </div>

      <!-- Gallery Grid -->
      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        <div 
          v-for="gallery in activeGalleries" 
          :key="gallery.id"
          @click="openModal(gallery.id)"
          class="relative group cursor-pointer rounded-lg overflow-hidden aspect-square bg-gray-100"
        >
          <img 
            :src="`/storage/${gallery.thumbnail || gallery.image}`" 
            :alt="gallery.title"
            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
          >
          <div class="absolute inset-0 bg-black bg-opacity-30 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
            <div class="text-white text-center p-4">
              <h3 class="font-bold text-lg">{{ gallery.title }}</h3>
              <p class="text-sm">{{ gallery.description?.substring(0, 50) }}{{ gallery.description?.length > 50 ? '...' : '' }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Gallery Modal -->
      <div v-if="selectedGallery" class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center">
          <!-- Overlay -->
          <div class="fixed inset-0 transition-opacity" @click="closeModal">
            <div class="absolute inset-0 bg-black opacity-75"></div>
          </div>

          <!-- Modal Content -->
          <div class="inline-block w-full max-w-4xl bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all my-8">
            <div class="bg-white p-6">
              <div class="flex justify-between items-start">
                <div class="flex-1">
                  <h3 class="text-2xl font-bold text-gray-900">{{ selectedGallery.title }}</h3>
                  <p class="text-gray-500 text-sm">
                    {{ formatDate(selectedGallery.created_at) }} • 
                    {{ selectedGallery.category?.name }}
                  </p>
                </div>
                <button @click="closeModal" class="text-gray-400 hover:text-gray-500">
                  <span class="sr-only">Close</span>
                  <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </div>

              <!-- Main Image -->
              <div class="mt-4">
                <img 
                  :src="`/storage/${selectedGallery.image}`" 
                  :alt="selectedGallery.title"
                  class="w-full h-auto max-h-[60vh] object-contain rounded-lg"
                >
              </div>

              <!-- Description -->
              <p class="mt-4 text-gray-700">{{ selectedGallery.description }}</p>

              <!-- Actions -->
              <div class="mt-6 flex items-center justify-between">
                <div class="flex space-x-4">
                  <button 
                    @click="toggleLike(selectedGallery)"
                    :class="[
                      'flex items-center space-x-1 px-4 py-2 rounded-full transition-colors',
                      selectedGallery.has_liked 
                        ? 'text-red-500 hover:bg-red-50' 
                        : 'text-gray-500 hover:bg-gray-100'
                    ]"
                  >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <span>{{ selectedGallery.likes_count || 0 }}</span>
                  </button>
                  
                  <button 
                    @click="toggleDislike(selectedGallery)"
                    :class="[
                      'flex items-center space-x-1 px-4 py-2 rounded-full transition-colors',
                      selectedGallery.has_disliked 
                        ? 'text-blue-500 hover:bg-blue-50' 
                        : 'text-gray-500 hover:bg-gray-100'
                    ]"
                  >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 019 6h4.5a2 2 0 011.789 1.106l1.5 3A2 2 0 0115 12h-3.5l-1 2H18m-8-2h8m0 0h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2a2 2 0 012-2h2" />
                    </svg>
                    <span>{{ selectedGallery.dislikes_count || 0 }}</span>
                  </button>
                </div>
                
                <div class="text-sm text-gray-500">
                  {{ selectedGallery.views || 0 }} views
                </div>
              </div>

              <!-- Comments Section -->
              <div class="mt-8 border-t border-gray-200 pt-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Comments ({{ selectedGallery.comments_count || 0 }})</h4>
                
                <!-- Add Comment -->
                <div class="mb-6">
                  <form @submit.prevent="addComment">
                    <div class="flex space-x-2">
                      <input 
                        v-model="newComment"
                        type="text" 
                        placeholder="Add a comment..."
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required
                      >
                      <button 
                        type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                      >
                        Post
                      </button>
                    </div>
                  </form>
                </div>

                <!-- Comments List -->
                <div class="space-y-4">
                  <div v-for="comment in selectedGallery.comments" :key="comment.id" class="flex items-start space-x-3">
                    <div class="flex-shrink-0">
                      <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                        {{ comment.user?.name?.charAt(0) || 'U' }}
                      </div>
                    </div>
                    <div class="flex-1 min-w-0">
                      <div class="bg-gray-50 p-3 rounded-lg">
                        <div class="flex justify-between items-start">
                          <p class="text-sm font-medium text-gray-900">{{ comment.user?.name || 'Anonymous' }}</p>
                          <span class="text-xs text-gray-500">{{ formatDate(comment.created_at) }}</span>
                        </div>
                        <p class="mt-1 text-sm text-gray-700">{{ comment.content }}</p>
                      </div>
                    </div>
                  </div>
                  
                  <div v-if="selectedGallery.comments_count > 5" class="text-center">
                    <button class="text-sm text-blue-500 hover:underline">
                      View all {{ selectedGallery.comments_count }} comments
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
  categories: {
    type: Array,
    required: true,
  },
  initialGalleries: {
    type: Array,
    default: () => [],
  },
});

const activeCategory = ref(props.categories[0]?.id || null);
const selectedGallery = ref(null);
const newComment = ref('');

const activeGalleries = computed(() => {
  if (!activeCategory.value) return [];
  const category = props.categories.find(c => c.id === activeCategory.value);
  return category?.galleries || [];
});

function openModal(galleryId) {
  // Fetch gallery details
  fetch(`/api/galleries/${galleryId}`)
    .then(response => response.json())
    .then(data => {
      selectedGallery.value = data;
      // Increment view count
      router.post(`/api/galleries/${galleryId}/view`);
    })
    .catch(error => console.error('Error fetching gallery:', error));
}

function closeModal() {
  selectedGallery.value = null;
  newComment.value = '';
}

function toggleLike(gallery) {
  if (!gallery) return;
  
  const method = gallery.has_liked ? 'delete' : 'post';
  
  fetch(`/api/galleries/${gallery.id}/like`, {
    method,
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
    },
  })
  .then(response => response.json())
  .then(data => {
    if (selectedGallery.value) {
      selectedGallery.value.likes_count = data.likes_count;
      selectedGallery.value.dislikes_count = data.dislikes_count;
      selectedGallery.value.has_liked = !selectedGallery.value.has_liked;
      selectedGallery.value.has_disliked = false;
    }
  });
}

function toggleDislike(gallery) {
  if (!gallery) return;
  
  const method = gallery.has_disliked ? 'delete' : 'post';
  
  fetch(`/api/galleries/${gallery.id}/dislike`, {
    method,
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
    },
  })
  .then(response => response.json())
  .then(data => {
    if (selectedGallery.value) {
      selectedGallery.value.likes_count = data.likes_count;
      selectedGallery.value.dislikes_count = data.dislikes_count;
      selectedGallery.value.has_disliked = !selectedGallery.value.has_disliked;
      selectedGallery.value.has_liked = false;
    }
  });
}

function addComment() {
  if (!newComment.value.trim() || !selectedGallery.value) return;
  
  fetch(`/api/galleries/${selectedGallery.value.id}/comments`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
    },
    body: JSON.stringify({
      content: newComment.value,
    }),
  })
  .then(response => response.json())
  .then(data => {
    if (selectedGallery.value) {
      if (!selectedGallery.value.comments) {
        selectedGallery.value.comments = [];
      }
      selectedGallery.value.comments.unshift(data.comment);
      selectedGallery.value.comments_count = data.comments_count;
      newComment.value = '';
    }
  });
}

function formatDate(dateString) {
  if (!dateString) return '';
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  return new Date(dateString).toLocaleDateString('id-ID', options);
}

// Close modal when pressing escape key
const handleEscape = (e) => {
  if (e.key === 'Escape' && selectedGallery.value) {
    closeModal();
  }
};

onMounted(() => {
  window.addEventListener('keydown', handleEscape);
});

onUnmounted(() => {
  window.removeEventListener('keydown', handleEscape);
});
</script>

<style scoped>
/* Custom scrollbar for modal */
.modal-content {
  max-height: calc(100vh - 2rem);
  overflow-y: auto;
  scrollbar-width: thin;
  scrollbar-color: #3b82f6 #f3f4f6;
}

.modal-content::-webkit-scrollbar {
  width: 8px;
}

.modal-content::-webkit-scrollbar-track {
  background: #f3f4f6;
  border-radius: 4px;
}

.modal-content::-webkit-scrollbar-thumb {
  background-color: #3b82f6;
  border-radius: 4px;
}
</style>
