<template>
  <ul class="list-group">
    <draggable
      v-model="links"
      item-key="id"
      tag="ul"
      class="list-group"
      ghost-class="bg-light"
      handle=".handle"
      @end="saveOrder"
    >
      <template #item="{ element: link }">
        <li
          class="list-group-item d-flex justify-content-between align-items-center"
          style="cursor: grab;"
          @mousedown="($event.currentTarget.style.cursor = 'grabbing')"
          @mouseup="($event.currentTarget.style.cursor = 'grab')"
        >
          <div class="d-flex align-items-center">
            <span class="handle me-3" style="cursor: grab;">≡</span>
            <div>
              <i v-if="link.icon" :class="link.icon + ' me-2'"></i>
              <strong>{{ link.title }}</strong>
              <span class="badge bg-secondary ms-2">{{ link.type }}</span>
              <div>
                <a :href="link.url" target="_blank" class="text-decoration-none">
                  {{ link.url }}
                </a>
              </div>
            </div>
          </div>
          <div class="btn-group">
            <button
              @click.prevent="edit(link.id)"
              class="btn btn-sm btn-outline-secondary"
            >
              Edit
            </button>
            <button
              @click.prevent="remove(link.id)"
              class="btn btn-sm btn-outline-danger"
            >
              Delete
            </button>
          </div>
        </li>
      </template>
    </draggable>
  </ul>
</template>

<script setup>
import { ref } from 'vue';
import draggable from 'vuedraggable';
import axios from 'axios';

const props = defineProps({
  initialLinks: Array,
  pageId: Number,
});

const links = ref([...props.initialLinks]);

// Save new order when dragging ends
async function saveOrder() {
  const order = links.value.map(l => l.id);
  try {
    await axios.post(`/pages/${props.pageId}/links/reorder`, { order });
  } catch (e) {
    console.error('Failed to save order', e);
  }
}

// Navigate to link edit page
function edit(id) {
  window.location.href = `/links/${id}/edit`;
}

// Delete link via API and update local list without refresh
async function remove(id) {
  if (!confirm('Delete this link?')) return;
  try {
    await axios.delete(`/links/${id}`);
    // Remove the deleted link from the list immediately
    links.value = links.value.filter(l => l.id !== id);
  } catch (e) {
    console.error('Failed to delete link', e);
    alert('Unable to delete link. Please try again.');
  }
}
</script>
