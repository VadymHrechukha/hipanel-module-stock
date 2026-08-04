import { test } from "@hipanel-core/fixtures";
import PartCreateView from "@hipanel-module-stock/page/PartCreateView";
import { UniqueId } from "@hipanel-core/shared/lib";
import PartIndexView from "@hipanel-module-stock/page/PartIndexView";
import PartView from "@hipanel-module-stock/page/PartView";

function getPartData() {
  return {
    partno: "EPYC 7402P",
    src_id: "TEST-DS-01",
    dst_id: "TEST-DS-02",
    serials: UniqueId.generate(`MG_TEST_PART`),
    move_descr: "MG TEST MOVE",
    price: 200,
    currency: "$",
    company_id: "Other",
  };
}

test.describe("Part Deletion", () => {
  test("Ensure a part can be created and then marked as deleted @hipanel-module-stock @manager", async ({ managerPage }) => {
    const partCreateView = new PartCreateView(managerPage);
    const partIndexView = new PartIndexView(managerPage);

    await partCreateView.navigate();
    await partCreateView.fillPartFields(getPartData());
    await partCreateView.save();

    await partIndexView.seePartWasCreated();

    const partView = new PartView(managerPage);
    await partView.markPartAsDeleted();
  });

  test("Ensure a part can be created and then erased @hipanel-module-stock @manager", async ({ managerPage }) => {
    const partCreateView = new PartCreateView(managerPage);
    const partIndexView = new PartIndexView(managerPage);

    await partCreateView.navigate();
    await partCreateView.fillPartFields(getPartData());
    await partCreateView.save();

    await partIndexView.seePartWasCreated();

    const partView = new PartView(managerPage);
    await partView.erasePart();
  });
});
