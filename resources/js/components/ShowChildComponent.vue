<template>
  <div>
    <div v-if="items.length" class="p-detail__child">
      <div class="p-detail__child__contentWrap" v-for="item in items" :key="item.id">
        <span class="p-detail__child__order u-weight_bold">ステップ{{item.order}}</span>
        <span class="p-detail__child__title">{{item.name}}</span>
      </div>
    </div>
    <div v-else>
      <p class="p-mypage__txt">ステップはまだ登録されていません。</p>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      items: []
    };
  },
  props: {
    parent_id: 0
  },
  methods: {
    // ステップ詳細に子ステップの目次を表示するために、リクエストして結果をitemsに格納
    request() {
      axios
        .get("/ajax?id=" + this.parent_id)
        .then(res => {
          console.log(res.data);
          let result = res.data;
          this.items = result;
        })
        .catch(error => console.log(error));
    }
  },
  // DOM作成前にrequestメソッドを実行
  created() {
    this.request();
  }
};
</script>
