import { adminRoot } from "./config";
import { UserRole } from "../utils/auth.roles";

const data = [
  {
  id: "dashboards",
  icon: "iconsminds-shop-4",
  label: "menu.dashboards",
  to: `${adminRoot}/dashboards`,
  // roles: [UserRole.Admin, UserRole.Editor],
},

{
  id: "orders",
  icon: "iconsminds-digital-drawing",
  label: "Orders",
  to: `${adminRoot}/orders`
},
{
  id: "categories",
  icon: "iconsminds-air-balloon-1",
  label: "Categories",
  to: `${adminRoot}/categories`,
},
{
  id: "products",
  icon: "iconsminds-pantone",
  label: "Products",
  to: `${adminRoot}/products`,
},
{
  id: "users",
  icon: "iconsminds-three-arrow-fork",
  label: "Users",
  to: `${adminRoot}/users`
},
];
export default data;
