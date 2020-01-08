<template>
  <div class="p-challenge">
    <div class="p-challenge__content">
      <h2 class="c-title">{{ items.childStep[current].name }}</h2>
      <p
        class="p-challenge__txt"
        style="white-space: pre-wrap;"
      >{{ items.childStep[current].content }}</p>
      <a
        v-if="items.num === items.progress"
        :href="'challenge/reset?id=' + parent_id"
        class="c-button c-button--wide u-mx_right u-mt_s"
      >進捗をリセット</a>
      <a
        v-else
        :href="'challenge/clear?id=' + parent_id + '&progress=' + current"
        class="c-button c-button--wide u-mx_right u-mt_s"
      >クリア！</a>
    </div>
    <div class="p-challenge__sidebar">
      <div class="p-detail__child">
        <a
          :href="'challenge?id=' + parent_id + '&current=' + (item.order - 1)"
          class="p-detail__child__contentWrap"
          :class="item.order === (Number(current) + 1) ? 'p-challenge__currentStep' : null"
          v-for="item in items.childStep"
          :key="item.id"
        >
          <span class="p-detail__child__order u-weight_bold">ステップ{{item.order}}</span>
          <span class="p-detail__child__title">{{item.name}}</span>
        </a>
      </div>
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
    parent_id: 0,
    current: 0
  },
  methods: {
    // チャレンジページのステップ情報をリクエストして、結果をitemsに格納する
    request() {
      axios
        .get("challenge/ajax?id=" + this.parent_id)
        .then(res => {
          console.log(res.data);
          let result = res.data;
          // 子ステップの数と進捗の数が同じ（全てクリアしている）、かつcurrentが子ステップより大きい（全てクリアした直後、あるいはGETに不正な値が入った）ときは、最初の子ステップを表示
          // 全てクリアしているステップでは、どの子ステップも閲覧可能にする（進捗リセットを押して、progressをリセットしない限り挑戦中のステップには表示しない）
          if (result.num === result.progress && result.num <= this.current) {
            this.current = 0;
          }
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
