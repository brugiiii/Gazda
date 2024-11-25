import refs from "../main/refs";
import { showToastMessage } from "../main/utils";

const { submitForm } = refs;
let url = settings.cta_url;
let ajax_url = `${url}/crm.lead.add.json`;

const handleFormSubmit = (e) => {
  e.preventDefault();

  const $this = $(e.currentTarget);
  const formTitle = $this.data("title");
  const formInputs = $this.find("input, textarea");
  const formButton = $this.find("button[type='submit']");

  const formData = {};
  formInputs.each(function () {
    const $input = $(this);
    const fieldTitle = $input.data("title");
    const value = $input.val();
    const fieldsID = {
      Адміністратор: 838,
      Бармен: 840,
      Бухгалтер: 842,
      "Клінінг менеджер": 844,
      Кухар: 846,
      "Кухар-піцейоло": 848,
      "Кухар-сушист": 850,
      "Менеджер з кадрів": 852,
      "Мийник посуду/прибиральниця": 854,
      Офіціант: 856,
      Пекар: 858,
      "Процес-менеджер": 860,
      "Системний адміністратор": 862,
      "HR менеджер": 864,
      Садівник: 866,
      Різноробочий: 868,
      "Помічник-гентеша": 870,
      Гентеш: 872,
      "Менеджер з доставки": 874,
      Фуршет: 876,
      Конференція: 878,
      Корпоратив: 880,
      Семінар: 882,
      Вечірка: 884,
      "Реклама у фейсбуку": 810,
      "Реклама у інстаграмі": 812,
      "У групі фейсбук": 814,
      "У Віктора Михайлова": 816,
      "Скинули друзі": 818,
      "На сайті пошуку роботи": 820,
      "Через вашого рекрутера": 822,
      "У телеграм каналі": 824,
      "На зовнішній рекламі (бігборди, сітілайти)": 826,
      Інше: 828,
      "Порядний Ґазда": 830,
      "Chizay Мала Гора": 832,
      "Food Love": 834,
      "Ще не визначились": 836,
      "Їж, пий скільки влізе": 1038,
      "Порційне меню": 1040,
      Дегустація: 1042,
    };

    if (fieldTitle && value) {
      const fieldTitles = fieldTitle.split(" ");
      fieldTitles.forEach((title) => {
        if (title.toUpperCase() == "EMAIL" || title.toUpperCase() == "PHONE") {
          let value_type = fieldTitle
            .split(" ")
            .slice(fieldTitle.indexOf(title) + 1, fieldTitle.length)
            .join(" ");
          if (!formData[title.toUpperCase()])
            formData[title.toUpperCase()] = [];
          formData[title.toUpperCase()].push({
            VALUE: value,
            VALUE_TYPE: value_type || "WORK",
          });
        } else if (title.toUpperCase() === "SELECT") {
          const selectFieldId = fieldTitles[1];
          formData[selectFieldId] = fieldsID[value];
        } else {
          const selectFieldId = fieldTitles[1];
          if (!formData[selectFieldId]) {
            formData[title.toUpperCase()] = value;
          }
        }
        console.log(formData, fieldTitle);
      });
    }
  });

  const data = {
    fields: {
      TITLE: formTitle,
      ...formData,
    },
    params: { REGISTER_SONET_EVENT: "Y" },
  };

  console.log(data);
  formButton.attr("disabled", true);

  $.ajax({
    type: "POST",
    url: ajax_url,
    data: JSON.stringify(data),
    contentType: "application/json",
    success: function (res) {
      formButton.attr("disabled", false);
      $this.trigger("reset");

      if (res.result) {
        console.log(res.result);
        showToastMessage("Lead created successfully", "success");
      } else {
        showToastMessage(
          "Error creating lead: " + res.error_description,
          "error"
        );
      }
    },
    error: function (error) {
      formButton.attr("disabled", false); // Re-enable the button on error
      console.error("Error submitting form", error);
      showToastMessage("Error submitting form", "error");
    },
  });
};

// Attach the event handler to the form submit event
submitForm.on("submit", handleFormSubmit);
