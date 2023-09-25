import AddEvent from "@/views/pages/AddEvent.vue";
import EventPage from "@/views/pages/EventPage.vue";
import Profile from "@/views/pages/Profile.vue";

export default [
  {
    path: '',
    name: 'cabinet',
    component: () => Profile,
  },
  {
    path: 'new',
    name: 'add-event',
    component: () => AddEvent,
  },
  {
    path: 'event-:id',
    name: 'event',
    component: () => EventPage,
  },
]