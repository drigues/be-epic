<template>
  <div class="row">
    <!-- Link list on left half -->
    <div class="col-12 col-lg-6 mb-4">
      <div v-for="page in pages" :key="page.id" class="card mb-3">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <strong>{{ page.username }}</strong><br>
            <small class="text-muted">{{ baseUrl }}/{{ page.username }}</small>
          </div>
          <div>
            <button @click="edit(page.id)" class="btn btn-sm btn-primary me-2">
              Edit
            </button>
            <button @click="del(page.id)" class="btn btn-sm btn-outline-danger">
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Live preview on right half -->
    <div class="col-12 col-lg-6">
      <div class="border rounded p-3" style="max-width:350px; margin:auto;">
        <h5 class="text-center mb-3">@{{ userHandle }}</h5>
        <div v-for="page in pages" :key="page.id" class="mb-2">
          <a
            :href="`${baseUrl}/${page.username}`"
            class="btn btn-light w-100 text-start"
            style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
            target="_blank"
          >
            {{ page.username }}
          </a>
        </div>
        <div class="text-center text-secondary small mt-2">
          Linktree clone by Clinky
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      pages: [],
      baseUrl: window.location.origin,
      userHandle: "{{ Auth::user()->name }}"
    }
  },
  methods: {
    fetchPages() {
      fetch('/api/pages')
        .then(r => r.json())
        .then(json => this.pages = json);
    },
    goToCreate() {
      window.location.href = "{{ route('pages.create') }}";
    },
    edit(id) {
      window.location.href = `/pages/${id}/edit`;
    },
    del(id) {
      if (!confirm('Delete this directory?')) return;
      fetch(`/pages/${id}`, {
        method: 'DELETE',
        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content}
      }).then(() => this.fetchPages());
    }
  },
  mounted() {
    this.fetchPages();
  }
}
</script>
