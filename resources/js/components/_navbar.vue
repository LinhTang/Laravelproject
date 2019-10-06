<template>
  <v-card class="overflow-hidden">
    <v-app-bar
      app
      fixed
      clipped-left
      color="#fcb69f"
      dark
      shrink-on-scroll
      src="https://picsum.photos/1920/1080?random"
      scroll-target="#scrolling-techniques-2"
    >
      <v-toolbar-title style="font-size: 30px; padding: 20px;">Food ordering</v-toolbar-title>
      <div class="flex-grow-1"></div>
      <v-menu offset-y origin="center center" :nudge-bottom="10" transition="scale-transition">
        <template #activator="data">
          <v-btn v-on="data.on" icon large text>
            <v-avatar size="30px">
              <v-icon>menu</v-icon>
            </v-avatar>
          </v-btn>
        </template>
        <v-list class="pa-0">
          <v-list-item ripple="ripple" rel="noopener" href="/home">
            <v-list-item-action>
              <v-icon>account_circle</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>{{user.name}}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>

        <v-list class="pa-0">
          <v-list-item href="/forums" ripple="ripple" rel="noopener">
            <v-list-item-action>
              <v-icon>forum</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Forum</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>

        <v-list class="pa-0">
          <v-list-item href="/chat" ripple="ripple" rel="noopener">
            <v-list-item-action>
              <v-icon>message</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Messages</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>

        <v-list class="pa-0">
          <v-list-item @click="logout" ripple="ripple" rel="noopener">
            <v-list-item-action>
              <v-icon>logout</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Logout</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-app-bar>
  </v-card>
</template>


<script>
export default {
  props: ["user"],
  data: () => ({
    drawer: null
  }),
  props: ["user"],

  methods: {
    logout() {
      axios.post("/logout").then(response => window.location.reload());
    }
  }
};
</script>
