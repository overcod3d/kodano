import { HydraAdmin, ResourceGuesser } from "@api-platform/admin";
import { ProductsCreate } from './ProductsCreate';
import { ProductsEdit } from './ProductsEdit';

const App = () => (
  <HydraAdmin
    entrypoint={window.origin}
    title="Kodano admin"
  >
    <ResourceGuesser name="categories" />

    <ResourceGuesser 
      name="products" 
      create={ProductsCreate}
      edit={ProductsEdit}
    />    
  </HydraAdmin>
);

export default App;