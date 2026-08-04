import { test } from "@hipanel-core/fixtures";
import PartCreateView from "@hipanel-module-stock/page/PartCreateView";
import PartIndexView from "@hipanel-module-stock/page/PartIndexView";
import { UniqueId } from "@hipanel-core/shared/lib";

function getPartData(serial: string) {
  return {
    partno: "EPYC 7402P",
    src_id: "TEST-DS-01",
    dst_id: "TEST-DS-02",
    serials: serial,
    move_descr: "MG TEST MOVE",
    price: 200,
    currency: "$",
    company_id: "Other",
  };
}

test.describe("Part Bulk Erase", () => {
  // HQD-306: bulk-erasing filtered, previously deleted parts got stuck on an infinite loading modal.
  test("Ensure deleted parts can be bulk erased after filtering @hipanel-module-stock @manager", async ({ managerPage }) => {
    // Part creation plus two bulk round-trips (mark deleted, then erase) is slow on a loaded dump env
    // -- a full run without the bug reproducing already takes ~2.5 minutes.
    test.setTimeout(300_000);

    const serialPrefix = UniqueId.generate("MG_TEST_ERASE_");
    const partCreateView = new PartCreateView(managerPage);
    const partIndexView = new PartIndexView(managerPage);

    await partCreateView.navigate();
    await partCreateView.fillPartFields(getPartData(`${serialPrefix}-1`));
    await partCreateView.addPart();
    await partCreateView.fillPartFields(getPartData(`${serialPrefix}-2`), 1);
    await partCreateView.save();

    await partIndexView.seePartWasCreated();

    await partIndexView.navigateCommon();
    await partIndexView.applyFilters([{ name: "serial_ilike", value: serialPrefix }]);
    await partIndexView.bulkMarkAsDeleted(2);

    await partIndexView.filterDeletedBySerial(serialPrefix);
    await partIndexView.bulkErase(2);
  });
});
