<template>
  <div id="bar">
    <v-list dense>
      <v-list-item href="/home">
        <v-list-item-action>
          <v-icon>home</v-icon>
        </v-list-item-action>
        <v-list-item-content id="t1">
          <v-list-item-title>Home</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item exact to="/company/dashboard">
        <v-list-item-action>
          <v-icon>dashboard</v-icon>
        </v-list-item-action>
        <v-list-item-content id="t1">
          <v-list-item-title>Dashboard</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item exact to="/company/morder">
        <v-list-item-action>
          <v-icon>account_circle</v-icon>
        </v-list-item-action>
        <v-list-item-content id="t1">
          <v-list-item-title>Order management</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </div>
</template>


<script>
export default {};
</script>

<style scoped>
#bar {
  padding: 30px 0 0 0;
}
#t1 {
  font-size: 50px;
  height: 50px;
  margin: 5px;
}
</style>


