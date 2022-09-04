import { adminRoot } from "./config";
import { UserRole } from "../utils/auth.roles";

const data = [
  {
  id: "dashboards",
  icon: "iconsminds-shop-4",
  label: "menu.dashboards",
  to: `${adminRoot}/dashboards`,
  roles: [UserRole.Admin, UserRole.Chef, UserRole.Staff],
},

{
  id: "orders",
  icon: "iconsminds-digital-drawing",
  label: "Orders",
  to: `${adminRoot}/orders`,
  roles: [UserRole.Admin],
},
{
  id: "stafforders",
  icon: "iconsminds-digital-drawing",
  label: "Orders",
  to: `${adminRoot}/stafforders`,
  roles: [UserRole.Staff],
},
{
  id: "cheforders",
  icon: "iconsminds-digital-drawing",
  label: "Orders",
  to: `${adminRoot}/cheforders`,
  roles: [UserRole.Chef],
},
{
  id: "categories",
  icon: "iconsminds-air-balloon-1",
  label: "Categories",
  to: `${adminRoot}/categories`,
  roles: [UserRole.Admin],
},
{
  id: "products",
  icon: "iconsminds-pantone",
  label: "Products",
  to: `${adminRoot}/products`,
  roles: [UserRole.Admin],
},
{
  id: "users",
  icon: "iconsminds-three-arrow-fork",
  label: "Users",
  to: `${adminRoot}/users`,
  roles: [UserRole.Admin],
},
];
export default data;
