<template>
  <div>
    <div id="secure">
      <h1 style="margin-left: 420px; padding: 20px">Order list</h1>
      <hr />
      <div class="col-sm-12" style="margin-left: 70px; padding: 10px">
        <input
          type="text"
          v-model="search"
          placeholder="Search username..."
          style="margin-right: 5px; border-style: solid; border-width:0.5px; border-radius: 5px;"
        />
        <input
          type="text"
          v-model="searchfood"
          placeholder="Search food..."
          style="margin-right: 250px; border-style: solid; border-width:0.5px; border-radius: 5px;"
        />
        Count: {{countfood}}
      </div>
      <div
        class="information"
        style="width: 800px; height: 600px; overflow-y: scroll; padding: 10px; margin: 0 80px;"
      >
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th style="padding-left: 5px;" @click="sort('branch')">Branch</th>
              <th style="padding-left: 5px;" @click="sort('username')">username</th>
              <th style="padding-left: 40px;" @click="sort('checked')">food</th>
              <th style="padding-left: 20px;" @click="sort('time')">time</th>
              <th>message</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="i in filteredList" :key="i">
              <td>{{i.branch}}</td>
              <td>{{i.username}}</td>
              <td>{{i.checked}}</td>
              <td>{{i.time}}</td>
              <td>{{i.mess}}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <hr />
      <select v-model="selected" style="margin-left: 80px; margin-bottom: 20px;">
        <option disabled value style="color: gray;">Please select one</option>
        <option>Branch</option>
        <option>Food</option>
      </select>
      <div
        class="ex"
        style="width: 800px; height: 600px; overflow-y: scroll; padding: 10px; margin: 0 80px;"
      >
        <table class="table table-hover">
          <thead>
            <tr>
              <th v-if="selected === 'branch'" style="padding-left: 40px;">Branch</th>
              <th v-else style="padding-left: 40px;">Food</th>
              <th v-if="selected === 'branch'">Food</th>
              <th v-else>Branch</th>
              <th>Sum of orders</th>
            </tr>
          </thead>
          <tbody v-for="(food, branch) in byname" :key="food">
            <tr>
              <td style="width: 300px; padding-left: 40px;">{{branch}}</td>
              <td>
                <tr v-for="p in food" :key="p">{{p}}</tr>
              </td>
              <td style="padding-left: 50px;">{{food.length}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Morder",

  data() {
    return {
      orderItem: [],
      interval: undefined,
      search: "",
      searchfood: "",
      setting: [],
      currentSort: "username",
      currentSortDir: "asc",
      selected: "",
      count: 0
    };
  },
  computed: {
    filteredList() {
      if (this.search) {
        return this.sortedList.filter(item => {
          return item.username.toLowerCase().match(this.search.toLowerCase());
        });
      } else {
        if (this.searchfood) {
          return this.sortedList.filter(item => {
            return item.checked
              .toLowerCase()
              .match(this.searchfood.toLowerCase());
          });
        } else {
          return this.sortedList;
        }
      }
    },
    countfood() {
      return this.filteredList.length;
    },
    sortedList: function() {
      return this.orderItem.sort((a, b) => {
        let modifier = 1;
        if (this.currentSortDir === "desc") modifier = -1;
        if (a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
        if (a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
        return 0;
      });
    },
    byname() {
      if (this.selected == "Branch") {
        return this.orderItem.reduce((acc, user) => {
          (acc[user.branch] = acc[user.branch] || []).push(user.checked);
          return acc;
        }, {});
      } else {
        return this.orderItem.reduce((acc, user) => {
          (acc[user.checked] = acc[user.checked] || []).push(user.branch);
          return acc;
        }, {});
      }
    }
  },
  mounted() {
    this.interval = setInterval(() => {
      axios.get("http://localhost:3000/order").then(response => {
        this.orderItem = response.data;
        console.log(response.data);
        console.log(this.orderItem);
      });
    }, 30000).catch(e => {
      this.errors.push(e);
    });
  },
  methods: {
    sort: function(s) {
      //if s == current sort, reverse
      if (s === this.currentSort) {
        this.currentSortDir = this.currentSortDir === "asc" ? "desc" : "asc";
      }
      this.currentSort = s;
    },
    sum(p) {
      this.count = this.acc[p].length;
    }
  }
};
</script>

<style scoped>
#secure {
  background-color: #ffffff;
  border: 1px solid #cccccc;
  padding: 20px;
  margin-top: 10px;
  font-size: 20px;
}
.opt {
  text-align: center;
  font-size: 20px;
  padding: 10px;
  position: absolute;
  top: 14%;
}

.opt a {
  text-decoration: none;
  display: inline-block;
  border: 1px solid gray;
  border-radius: 3px;
  width: 100px;
  box-sizing: border-box;
  color: gray;
}

.opt a:hover,
.opt a:active {
  background-color: gray;
  color: white;
}
select {
  border-style: double;
  width: 300px;
}
</style>