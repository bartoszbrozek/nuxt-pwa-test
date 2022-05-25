<template>
  <v-row>
    <v-col class="text-center">
      <img src="/v.png" alt="Vuetify.js" class="mb-5" />
      <blockquote class="blockquote">
        Purchase Items

        <h6>Is Online: {{ isOnline }}</h6>

        <table>
          <tr v-for="(item, index) in items" :key="index">
            <td>{{ item.id }}</td>
            <td>{{ item.name }}</td>
            <td>${{ item.price }}</td>
            <td>
              <input
                type="checkbox"
                v-model="selectedItems"
                :value="item.id"
                @change="isPurchased = false"
              />
            </td>
          </tr>
        </table>

        <button @click="purchase()">Purchase Selected Items</button>

        <h1 v-show="isPurchased">
          Thank you for ordering these items: {{ selectedItems }}
        </h1>

        <footer>
          <small> </small>
        </footer>
      </blockquote>
    </v-col>
  </v-row>
</template>

<script>
export default {
  data() {
    return {
      items: [],
      selectedItems: [],
      isPurchased: false,
      isOnline: false,
    };
  },

  mounted() {
    this.isOnline = navigator.onLine;

    setInterval(() => {
      this.isOnline = navigator.onLine;

      console.log(navigator.onLine);
    }, 5000);

    var self = this;

    $nuxt.$axios.$get(`/?action=getItems`).then((data) => {
      self.items = data;
    });
  },

  methods: {
    purchase() {
      this.isPurchased = false;

      const data = this.selectedItems;
      return $nuxt.$axios.$post(`/?action=purchase`, data).then(() => {
        this.isPurchased = true;
      });
    },
  },
};
</script>
